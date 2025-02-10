import { test, expect, request } from '@playwright/test';

// กำหนดค่าพื้นฐานของ API
const API_URL = 'https://api.elsevier.com/content/search/scopus';
const API_KEY = '6ab3c2a01c29f0e36b00c8fa1d013f83';
const AUTHOR_QUERY = 'AUTHOR-NAME(Horata,P.)';

async function fetchScopusData(request, query) {
    const response = await request.get(API_URL, {
        params: { query, apiKey: API_KEY },
        headers: { 'Accept': 'application/json' }
    });
    return response;
}

test.describe('Scopus API Testing', () => {
    
    test('TC001: ตรวจสอบการดึงข้อมูลจาก Scopus API เมื่อการเรียกสำเร็จ', async ({ request }) => {
        const response = await fetchScopusData(request, AUTHOR_QUERY);
        expect(response.status()).toBe(200);

        const responseBody = await response.json();
        expect(responseBody).toHaveProperty('search-results');
        expect(responseBody['search-results']).toHaveProperty('opensearch:totalResults');
        expect(responseBody['search-results']).toHaveProperty('entry');

        const totalResults = parseInt(responseBody['search-results']['opensearch:totalResults']);
        expect(totalResults).toBeGreaterThan(0);

        const firstEntry = responseBody['search-results']['entry'][0];
        expect(firstEntry).toHaveProperty('dc:title');
        expect(firstEntry).toHaveProperty('prism:url');
        expect(firstEntry).toHaveProperty('prism:publicationName');
        expect(firstEntry).toHaveProperty('prism:volume');

        if ('prism:issueIdentifier' in firstEntry) {
            expect(firstEntry).toHaveProperty('prism:issueIdentifier');
        }
        expect(firstEntry).toHaveProperty('prism:coverDate');
        expect(firstEntry).toHaveProperty('prism:doi');
        expect(firstEntry).toHaveProperty('citedby-count');
        expect(firstEntry).toHaveProperty('prism:aggregationType');
        expect(firstEntry).toHaveProperty('subtypeDescription');
    });
    
    test('TC002: ตรวจสอบเมื่อ API เกิดข้อผิดพลาด (Bad Request)', async ({ request }) => {
        const invalidResponse = await request.get(API_URL, {
            params: { apiKey: API_KEY }
        });
        expect(invalidResponse.status()).toBe(400);
    });

    test('TC003: ตรวจสอบเมื่อค้นหานักวิจัยที่ไม่มีข้อมูล', async ({ request }) => {
        const response = await fetchScopusData(request, 'AUTHOR-NAME(NonExistent, X.)');
        expect(response.status()).toBe(200);
        
        const responseBody = await response.json();
        expect(responseBody['search-results']['opensearch:totalResults']).toBe('0');
    });

    test('TC004: ตรวจสอบเมื่อ API ตอบกลับ HTTP 404 (Not Found)', async ({ request }) => {
        const fakeAPIUrl = 'https://api.elsevier.com/fake-endpoint';
        const response = await request.get(fakeAPIUrl, {
            params: { query: AUTHOR_QUERY, apiKey: API_KEY }
        });
        expect(response.status()).toBe(404);
    });

    test('TC005: ตรวจสอบว่าทุกเอกสารมี DOI (ถ้ามี)', async ({ request }) => {
        const response = await request.get(API_URL, {
            params: {
                query: AUTHOR_QUERY,
                apiKey: API_KEY
            }
        });
    
        expect(response.status()).toBe(200);
    
        const responseBody = await response.json();
        const entries = responseBody['search-results']['entry'];
    
        expect(Array.isArray(entries)).toBe(true);
        expect(entries.length).toBeGreaterThan(0);
    
        for (const entry of entries) {
            expect(entry).toHaveProperty('prism:url'); 
            if ('prism:doi' in entry) {
                expect(entry).toHaveProperty('prism:doi');
            } else {
                console.warn(`⚠️ Missing DOI for entry: ${entry['dc:identifier']}`);
            }
        }
    });
    
});
