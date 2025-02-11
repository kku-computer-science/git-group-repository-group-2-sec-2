<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('papers', function (Blueprint $table) {
            // ✅ เพิ่มคอลัมน์ใหม่ที่จำเป็น
            $table->string('paper_sourcetitle')->nullable()->after('paper_subtype'); // ระบุแหล่งที่มา
            $table->string('paper_url')->nullable()->after('paper_sourcetitle'); // ลิงก์ของ Paper
            $table->integer('paper_yearpub')->nullable()->after('paper_url'); // ปีที่ตีพิมพ์
            $table->integer('paper_citation')->default(0)->after('paper_yearpub'); // จำนวนการอ้างอิง
            $table->text('abstract')->nullable()->after('paper_citation'); // บทคัดย่อ

            // ✅ ปรับขนาดคอลัมน์บางส่วนให้รองรับข้อมูลมากขึ้น
            $table->string('paper_name', 500)->change();
        });
    }

    public function down()
    {
        Schema::table('papers', function (Blueprint $table) {
            // ✅ ลบคอลัมน์ที่เพิ่มมา หากต้องการ Rollback
            $table->dropColumn(['paper_sourcetitle', 'paper_url', 'paper_yearpub', 'paper_citation', 'abstract']);

            // ✅ คืนค่าขนาดคอลัมน์ paper_name กลับไปเป็นค่าเดิม
            $table->string('paper_name', 255)->change();
        });
    }
};

