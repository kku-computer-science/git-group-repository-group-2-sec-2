import { test, expect } from '@playwright/test';

test.describe('Profile Page - UAT Testing', () => {
    test.beforeEach(async ({ page }) => {
        // เปิดหน้า Profile นักวิจัย
        await page.goto('http://127.0.0.1:8000/detail/eyJpdiI6InA3ODc2ZDA0SFYwNnNNK24zcVoyK3c9PSIsInZhbHVlIjoiT1ZFeHppamxDbGd5Y0tocmM2WTA4QT09IiwibWFjIjoiYTVhOTFjN2I3ZDBmZTA0MTlmNTM0NmI4MDZiN2Q5MDc3OGY5MDdmOTA1OGNjYjRmYzYzY2JhZDg5M2M5MjAwNyIsInRhZyI6IiJ9');
    });

    // 1️⃣ UI/UX Testing
    test('TC001: ตรวจสอบการแสดงข้อมูลโปรไฟล์', async ({ page }) => {
        await expect(page.locator('h6:has-text("Pusadee Seresangtakul")')).toBeVisible();
        await expect(page.locator('text=Assistant Professor')).toBeVisible();
        await expect(page.locator('text=pusadee@kku.ac.th')).toBeVisible();
    });

    test('TC002: ตรวจสอบรูปโปรไฟล์', async ({ page }) => {
        const profileImage = page.locator('.card-image');
        await expect(profileImage).toBeVisible();
        await expect(profileImage).toHaveAttribute('src', /.*\.jpg|.*\.png/);
    });

    test('TC003: ตรวจสอบการแสดงกราฟ Publications', async ({ page }) => {
        await expect(page.locator('#barChart')).toBeVisible();
    });

    test('TC004: ตรวจสอบการโหลดข้อมูล SCOPUS', async ({ page }) => {
        await expect(page.locator('#scopus-tab')).toBeVisible();
        await page.locator('#scopus-tab').click();
        await expect(page.locator('#example2 tbody tr')).toHaveCount(10);
    });

    test('TC005: ตรวจสอบปุ่ม Export To Excel (เฉพาะในแท็บ Summary)', async ({ page }) => {
        const exportButton = page.locator('text=Export To Excel');
        await expect(exportButton).toBeVisible();
        await exportButton.click();
        
        // ตรวจสอบว่ามีการดาวน์โหลดไฟล์ Excel
        const [download] = await Promise.all([
            page.waitForEvent('download'), // รอให้เกิด event download
            exportButton.click() // คลิกปุ่ม Export
        ]);
        
        expect(download).toBeTruthy();
    });

    // 2️⃣ Functionality Testing
    test('TC007: ตรวจสอบการค้นหาใน SCOPUS', async ({ page }) => {
        await page.locator('#scopus-tab').click();
        await page.locator('#example2_filter input[type="search"]').fill('Multi-stroke thai');
        await expect(page.locator('#example2 tbody tr')).toHaveCount(1);
    });

    test('TC008: ตรวจสอบการค้นหาใน TCI', async ({ page }) => {
        await page.locator('#tci-tab').click();
        await page.locator('#example4_filter input[type="search"]').fill('Database to Ontology Mapping System');
        await expect(page.locator('#example4 tbody tr')).toHaveCount(1);
    });

    test('TC009: ตรวจสอบ Pagination ของตาราง SCOPUS', async ({ page }) => {
        await page.locator('#scopus-tab').click();
        await page.locator('#example2_paginate a:has-text("Next")').click();
        await expect(page.locator('#example2 tbody tr')).toHaveCount(10);
    });

    test('TC010: ตรวจสอบการเปลี่ยนจำนวนแถวที่แสดง', async ({ page }) => {
        await page.locator('#scopus-tab').click();
        await page.selectOption('select[name="example2_length"]', '25');
        await expect(page.locator('#example2 tbody tr')).toHaveCount(25);
    });

    test('TC011: ตรวจสอบการเรียงลำดับข้อมูล', async ({ page }) => {
        await page.locator('#scopus-tab').click();
    
        // คลิกปุ่ม "Year" สองครั้งเพื่อให้เรียงจากมากไปน้อย
        await page.locator('#example2 thead th:has-text("Year")').click();
        await page.locator('#example2 thead th:has-text("Year")').click();
    
        // ตรวจสอบว่าค่าปีในแถวแรกเป็นค่าล่าสุด
        const firstRowYear = await page.locator('#example2 tbody tr:first-child td:nth-child(2)').innerText();
        console.log(`🔍 Debug: ค่าจริงของปีในแถวแรก = ${firstRowYear}`); // Debug log
    
        await expect(page.locator('#example2 tbody tr:first-child td:nth-child(2)')).toHaveText('2024');
    });
    

    test('TC012: ตรวจสอบการโหลดข้อมูล Publications', async ({ page }) => {
        await expect(page.locator('#scopus-tab')).toBeVisible();
        await expect(page.locator('#tci-tab')).toBeVisible();
    });

    test('TC013: ตรวจสอบแท็บเมนู', async ({ page }) => {
        await page.locator('#tci-tab').click();
    
        // ตรวจสอบว่าตารางมีแถวอย่างน้อย 1 แถว
        await expect(page.locator('#example4 tbody tr')).not.toHaveCount(0);
    });
    
    test('TC014: ตรวจสอบกรณีไม่มีข้อมูลในตาราง', async ({ page }) => {
        await page.locator('#wos-tab').click();
        await expect(page.locator('text=No data available in table')).toBeVisible();
    });

    test('TC015: ตรวจสอบการค้นหาที่ไม่มีผลลัพธ์', async ({ page }) => {
        await page.locator('#scopus-tab').click();
        await page.locator('#example2_filter input[type="search"]').fill('Not Existing Paper');
        await expect(page.locator('text=No matching records found')).toBeVisible();
    });
});
