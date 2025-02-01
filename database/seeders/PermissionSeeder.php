<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            // Posting
            ['name' => 'ایجاد پست', 'description' => 'ایجاد یک پست جدید', 'status' => 1, 'created_at' => now()],
            ['name' => 'مشاهده پست', 'description' => 'مشاهده پست‌ها', 'status' => 1, 'created_at' => now()],
            ['name' => 'ویرایش پست', 'description' => 'ویرایش پست موجود', 'status' => 1, 'created_at' => now()],
            ['name' => 'حذف پست', 'description' => 'حذف یک پست', 'status' => 1, 'created_at' => now()],

            // Ticketing
            ['name' => 'ایجاد تیکت', 'description' => 'ایجاد یک تیکت جدید', 'status' => 1, 'created_at' => now()],
            ['name' => 'مشاهده تیکت', 'description' => 'مشاهده تیکت‌ها', 'status' => 1, 'created_at' => now()],
            ['name' => 'ویرایش تیکت', 'description' => 'ویرایش تیکت موجود', 'status' => 1, 'created_at' => now()],
            ['name' => 'حذف تیکت', 'description' => 'حذف یک تیکت', 'status' => 1, 'created_at' => now()],

            // Commenting
            ['name' => 'ایجاد نظر', 'description' => 'ایجاد یک نظر جدید', 'status' => 1, 'created_at' => now()],
            ['name' => 'مشاهده نظر', 'description' => 'مشاهده نظرات', 'status' => 1, 'created_at' => now()],
            ['name' => 'ویرایش نظر', 'description' => 'ویرایش نظر موجود', 'status' => 1, 'created_at' => now()],
            ['name' => 'حذف نظر', 'description' => 'حذف یک نظر', 'status' => 1, 'created_at' => now()],
        ];

        // Insert into the permissions table
        DB::table('permissions')->insert($permissions);
    }
}
