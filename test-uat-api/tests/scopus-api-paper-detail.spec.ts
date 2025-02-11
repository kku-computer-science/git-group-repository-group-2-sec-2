import { test, expect, request } from '@playwright/test';

const BASE_URL = 'https://api.elsevier.com/content/abstract/scopus_id/';
const VALID_API_KEY = '6ab3c2a01c29f0e36b00c8fa1d013f83';
const INVALID_API_KEY = 'invalid-api-key';
const VALID_SCOPUS_ID = '85207239454';
const INVALID_SCOPUS_ID = '00000000000';

async function fetchScopusData(request, scopusId, apiKey) {
    try {
        const response = await request.get(`${BASE_URL}${scopusId}`, {
            params: { filed: 'authors', apiKey: apiKey },
            headers: { 'Accept': 'application/json' }
        });

        if (!response.ok()) {
            console.error(`Error ${response.status()}: ${await response.text()}`);
        }

        return response;
    } catch (error) {
        console.error('API Request Failed:', error);
        throw error;
    }
}

// ทดสอบการดึงข้อมูล SCOPUS ด้วย SCOPUS ID ที่ถูกต้อง
test('ทดสอบการดึงข้อมูล SCOPUS ด้วย SCOPUS ID ที่ถูกต้อง', async ({ request }) => {
    const response = await fetchScopusData(request, VALID_SCOPUS_ID, VALID_API_KEY);
    expect(response.status()).toBe(200);

    const data = await response.json();
    const coreData = data['abstracts-retrieval-response']['coredata'];

    // ตรวจสอบค่าหลัก ๆ
    expect(coreData['dc:identifier']).toBe(`SCOPUS_ID:${VALID_SCOPUS_ID}`);
    expect(coreData['dc:title']).toBe('Service priority classification using machine learning');
    expect(coreData['prism:doi']).toBe('10.69598/sehs.18.24020002');
    expect(coreData['dc:publisher']).toBe('Silpakorn University');
    expect(coreData['prism:publicationName']).toBe('Science, Engineering and Health Studies');
    expect(coreData['prism:coverDate']).toBe('2024-01-01');
    expect(parseInt(coreData['citedby-count'])).toBe(0);

    // ตรวจสอบรายชื่อผู้เขียน
    // ตรวจสอบรายชื่อผู้เขียน
    // const authorsArray = data['abstracts-retrieval-response']['coredata']?.['dc:creator']?.['author'] || [];
    // const authors = Array.isArray(authorsArray) ? authorsArray : [authorsArray];

    // // ตรวจสอบว่ามีข้อมูลนักวิจัย
    // expect(authors.length).toBeGreaterThan(0);
    // expect(authors).toEqual(expect.arrayContaining([
    //     expect.objectContaining({ "ce:indexed-name": "Boonprapapan T." }),
    //     expect.objectContaining({ "ce:indexed-name": "Seresangtakul P." }),
    //     expect.objectContaining({ "ce:indexed-name": "Horata P." })
    // ]));

    

    // แก้ไขโค้ดดึงข้อมูลนักวิจัย
    const authorsArray = data['abstracts-retrieval-response']['authors']?.['author'] || [];
const authors = Array.isArray(authorsArray) ? authorsArray : [authorsArray];


    // ตรวจสอบว่ามีข้อมูลนักวิจัย
    expect(authors.length).toBeGreaterThan(0);
    expect(authors).toEqual(expect.arrayContaining([
        expect.objectContaining({ "ce:indexed-name": "Boonprapapan T." }),
        expect.objectContaining({ "ce:indexed-name": "Seresangtakul P." }),
        expect.objectContaining({ "ce:indexed-name": "Horata P." })
    ]));


    // ตรวจสอบ keywords
    const keywordsArray = data['abstracts-retrieval-response']['authkeywords']?.['author-keyword'] || [];
    const keywords = Array.isArray(keywordsArray)
        ? keywordsArray.map(k => k.$)
        : keywordsArray.$ ? [keywordsArray.$]
            : [];


    expect(keywords.length).toBeGreaterThan(0);
    expect(keywords).toContain('classification');
    expect(keywords).toContain('machine learning');
    expect(keywords).toContain('SMOTE');

    // ตรวจสอบ Abstract
    const abstractText = coreData?.['dc:description']?.['abstract']?.['ce:para'];
    expect(abstractText).not.toBeNull();
});

// ทดสอบการจัดการข้อผิดพลาดของ SCOPUS API
test.describe('ทดสอบการจัดการข้อผิดพลาดของ SCOPUS API', () => {

    // ทดสอบ SCOPUS ID ที่ไม่ถูกต้อง ควรได้ 404 Not Found
    test('ทดสอบ SCOPUS ID ที่ไม่ถูกต้อง ควรได้ 404 Not Found', async ({ request }) => {
        const response = await fetchScopusData(request, INVALID_SCOPUS_ID, VALID_API_KEY);
        expect(response.status()).toBe(404);
    });

    // ทดสอบการใช้ API Key ที่ไม่ถูกต้อง ควรได้ 401 Unauthorized
    test('ทดสอบ API Key ที่ไม่ถูกต้อง ควรได้ 401 Unauthorized', async ({ request }) => {
        const response = await fetchScopusData(request, VALID_SCOPUS_ID, INVALID_API_KEY);
        expect(response.status()).toBe(401);
    });

    // ทดสอบการไม่ส่ง API Key ควรได้ 401 Unauthorized
    test('ทดสอบการไม่ส่ง API Key ควรได้ 401 Unauthorized', async ({ request }) => {
        const response = await request.get(`${BASE_URL}${VALID_SCOPUS_ID}`, {
            params: { filed: 'authors' },
            headers: { 'Accept': 'application/json' }
        });
        expect(response.status()).toBe(401);
    });

    // ทดสอบการใช้ HTTP Method ที่ผิด ควรได้ 405 Method Not Allowed
    test('ทดสอบการใช้ HTTP Method ที่ผิด ควรได้ 405 Method Not Allowed', async ({ request }) => {
        const response = await request.put(`${BASE_URL}${VALID_SCOPUS_ID}`, {
            params: { filed: 'authors', apiKey: VALID_API_KEY },
            headers: { 'Accept': 'application/json' }
        });
        expect(response.status()).toBe(405);
    });

});
