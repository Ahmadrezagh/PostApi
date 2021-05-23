<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

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
            [
                'Admin',
                'مدیر ها'
            ],
            [
                'Category',
                'دسته بندی ها'
            ],
            [
                'User',
                'کاربران'
            ],
            [
                'Setting',
                'تنظیمات'
            ],
            [
            'CreatePost',
                'گذاشتن پست'
            ],
            [
                'GetPosts',
                'نمایش پست ها'
            ],
            [
                'GetPost',
                'نمایش یک پست'
            ],
            [
                'UpdatePost',
                'بروزرسانی پست'
            ],
            [
                'RemovePost',
                'حذف پست'
            ],

        ];
        foreach ($permissions as $permission)
        {
            Permission::create([
                'name' => $permission[0],
                'english_name' => $permission[0],
                'persian_name' => $permission[1]
            ]);
        }
    }
}
