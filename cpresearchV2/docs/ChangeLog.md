### Change Log Sprint 3

**Product Backlog Item:** As a user, I want to switch language at all time.

### [11 มีนาคม 2025]

#### เพิ่มข้อมูลลงในฐานข้อมูล:
1. **พี่ยศ นันทสิทธิ์ บางใบ**  
   - บทบาท: System Administrator  
   - Email: nantas@kku.ac.th  

2. **พี่หม่อม โรจนวรรณ หาดี**  
   - บทบาท: Educator  
   - Email: rojanha@kku.ac.th  

3. **พี่เล็ก ธารวิภา เหล่าชัย**  
   - บทบาท: Press Agent  
   - Email: thanlao@kku.ac.th  

4. **Arfat Ahmad Khan**  
   - บทบาท: Teacher (ต่างชาติ)  
   - Email: arfatkhan@kku.ac.th  

5. **Fan Bingbing**  
   - บทบาท: นศ.จีน  
   - Email: fanbing@kkumail.com  

6. **ปัญญาพล หอระตะ**  
   - บทบาท: อาจารย์ + หัวหน้าโครงการ  
   - Email: punhor1@kku.ac.th  
   - รหัสผ่าน: 123456789 (ทุก User)

#### เพิ่มคอลัมน์ในฐานข้อมูล:
7. **ตาราง programs**
   - เพิ่มคอลัมน์ `program_name_zh`
   - อัปเดตค่า `program_name_zh` ตาม `program_name_en`

8. **ตาราง degrees**
   - เพิ่มคอลัมน์ `degree_name_zh`
   - อัปเดตค่า `degree_name_zh` ตาม `degree_name_en`

9. **ตาราง departments**
   - เพิ่มคอลัมน์ `department_name_zh`
   - อัปเดตค่า `department_name_zh` ตาม `department_name_en`

#### แก้ไข Controller:
- เพิ่ม **Search** ใน Controller เพื่อสามารถค้นหาชื่อผู้วิจัยได้ 3 ภาษา และค้นหาความเชี่ยวชาญได้ 3 ภาษา  
- ปรับปรุงให้มีความเสถียรและทำงานได้อย่างถูกต้อง

#### ปรับปรุงการเข้าถึงและความปลอดภัย:
- แก้ไข **สิทธิการเข้าถึงของ Staff** แต่ละคนตามบทบาท เพื่อให้การจัดการเนื้อหามีความปลอดภัยและควบคุมได้อย่างเหมาะสม
- แก้ไข **สิทธิการเข้าถึงของ Master Student** เพิ่มสิทธิ์ `projects-list` และ `groups-list` เพื่อให้สามารถเข้าถึงข้อมูลที่จำเป็นได้

#### จัดทำคู่มือการใช้งาน (User Manual):
- จัดทำ **User Manual** เพื่อช่วยให้สามารถใช้งานการแปลภาษาได้อย่างมีประสิทธิภาพและถูกต้อง
