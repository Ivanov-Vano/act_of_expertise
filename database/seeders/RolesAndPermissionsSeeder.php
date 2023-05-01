<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\PermissionRegistrar;
use App\Models\Role;
use App\Models\Permission;


class RolesAndPermissionsSeeder extends Seeder
{
    /**
     *
     * Сидер для первоначальной записи минимальных значений роли, разрешений и пользователей
     *
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // reset cached roles and permissions (сбросить кешированные роли и разрешения)
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        //Misc (пустышка)
        $miscPermission = Permission::create(['name' => 'N/A']);

        //Act model
        $actPermission1 = Permission::create(['name' => 'просмотр всех: акт экспертизы']);
        $actPermission2 = Permission::create(['name' => 'просмотр: акт экспертизы']);
        $actPermission3 = Permission::create(['name' => 'создание: акт экспертизы']);
        $actPermission4 = Permission::create(['name' => 'изменение: акт экспертизы']);
        $actPermission5 = Permission::create(['name' => 'удаление: акт экспертизы']);
        $actPermission6 = Permission::create(['name' => 'восстановление: акт экспертизы']);
        $actPermission7 = Permission::create(['name' => 'безвозвратное удаление: акт экспертизы']);

        //Attachment model
        $attachmentPermission1 = Permission::create(['name' => 'просмотр всех: приложение']);
        $attachmentPermission2 = Permission::create(['name' => 'просмотр: приложение']);
        $attachmentPermission3 = Permission::create(['name' => 'создание: приложение']);
        $attachmentPermission4 = Permission::create(['name' => 'изменение: приложение']);
        $attachmentPermission5 = Permission::create(['name' => 'удаление: приложение']);
        $attachmentPermission6 = Permission::create(['name' => 'восстановление: приложение']);
        $attachmentPermission7 = Permission::create(['name' => 'безвозвратное удаление: приложение']);

        //CodeGroup model
        $codeGroupPermission1 = Permission::create(['name' => 'просмотр всех: правило']);
        $codeGroupPermission2 = Permission::create(['name' => 'просмотр: правило']);
        $codeGroupPermission3 = Permission::create(['name' => 'создание: правило']);
        $codeGroupPermission4 = Permission::create(['name' => 'изменение: правило']);
        $codeGroupPermission5 = Permission::create(['name' => 'удаление: правило']);
        $codeGroupPermission6 = Permission::create(['name' => 'восстановление: правило']);
        $codeGroupPermission7 = Permission::create(['name' => 'безвозвратное удаление: правило']);

        //Company model
        $companyPermission1 = Permission::create(['name' => 'просмотр всех: компания']);
        $companyPermission2 = Permission::create(['name' => 'просмотр: компания']);
        $companyPermission3 = Permission::create(['name' => 'создание: компания']);
        $companyPermission4 = Permission::create(['name' => 'изменение: компания']);
        $companyPermission5 = Permission::create(['name' => 'удаление: компания']);
        $companyPermission6 = Permission::create(['name' => 'восстановление: компания']);
        $companyPermission7 = Permission::create(['name' => 'безвозвратное удаление: компания']);

        //Expert model
        $expertPermission1 = Permission::create(['name' => 'просмотр всех: эксперт']);
        $expertPermission2 = Permission::create(['name' => 'просмотр: эксперт']);
        $expertPermission3 = Permission::create(['name' => 'создание: эксперт']);
        $expertPermission4 = Permission::create(['name' => 'изменение: эксперт']);
        $expertPermission5 = Permission::create(['name' => 'удаление: эксперт']);
        $expertPermission6 = Permission::create(['name' => 'восстановление: эксперт']);
        $expertPermission7 = Permission::create(['name' => 'безвозвратное удаление: эксперт']);

        //Measure model
        $measurePermission1 = Permission::create(['name' => 'просмотр всех: единица измерения']);
        $measurePermission2 = Permission::create(['name' => 'просмотр: единица измерения']);
        $measurePermission3 = Permission::create(['name' => 'создание: единица измерения']);
        $measurePermission4 = Permission::create(['name' => 'изменение: единица измерения']);
        $measurePermission5 = Permission::create(['name' => 'удаление: единица измерения']);
        $measurePermission6 = Permission::create(['name' => 'восстановление: единица измерения']);
        $measurePermission7 = Permission::create(['name' => 'безвозвратное удаление: единица измерения']);

        //Organization model
        $organizationPermission1 = Permission::create(['name' => 'просмотр всех: организация']);
        $organizationPermission2 = Permission::create(['name' => 'просмотр: организация']);
        $organizationPermission3 = Permission::create(['name' => 'создание: организация']);
        $organizationPermission4 = Permission::create(['name' => 'изменение: организация']);
        $organizationPermission5 = Permission::create(['name' => 'удаление: организация']);
        $organizationPermission6 = Permission::create(['name' => 'восстановление: организация']);
        $organizationPermission7 = Permission::create(['name' => 'безвозвратное удаление: организация']);

        //Position model
        $positionPermission1 = Permission::create(['name' => 'просмотр всех: товарная позиция']);
        $positionPermission2 = Permission::create(['name' => 'просмотр: товарная позиция']);
        $positionPermission3 = Permission::create(['name' => 'создание: товарная позиция']);
        $positionPermission4 = Permission::create(['name' => 'изменение: товарная позиция']);
        $positionPermission5 = Permission::create(['name' => 'удаление: товарная позиция']);
        $positionPermission6 = Permission::create(['name' => 'восстановление: товарная позиция']);
        $positionPermission7 = Permission::create(['name' => 'безвозвратное удаление: товарная позиция']);

        //Product model
        $productPermission1 = Permission::create(['name' => 'просмотр всех: товар']);
        $productPermission2 = Permission::create(['name' => 'просмотр: товар']);
        $productPermission3 = Permission::create(['name' => 'создание: товар']);
        $productPermission4 = Permission::create(['name' => 'изменение: товар']);
        $productPermission5 = Permission::create(['name' => 'удаление: товар']);
        $productPermission6 = Permission::create(['name' => 'восстановление: товар']);
        $productPermission7 = Permission::create(['name' => 'безвозвратное удаление: товар']);

        //Subposition model
        $subpositionPermission1 = Permission::create(['name' => 'просмотр всех: товарная подпозиция']);
        $subpositionPermission2 = Permission::create(['name' => 'просмотр: товарная подпозиция']);
        $subpositionPermission3 = Permission::create(['name' => 'создание: товарная подпозиция']);
        $subpositionPermission4 = Permission::create(['name' => 'изменение: товарная подпозиция']);
        $subpositionPermission5 = Permission::create(['name' => 'удаление: товарная подпозиция']);
        $subpositionPermission6 = Permission::create(['name' => 'восстановление: товарная подпозиция']);
        $subpositionPermission7 = Permission::create(['name' => 'безвозвратное удаление: товарная подпозиция']);

        //TypeAct model
        $typeActPermission1 = Permission::create(['name' => 'просмотр всех: тип акта']);
        $typeActPermission2 = Permission::create(['name' => 'просмотр: тип акта']);
        $typeActPermission3 = Permission::create(['name' => 'создание: тип акта']);
        $typeActPermission4 = Permission::create(['name' => 'изменение: тип акта']);
        $typeActPermission5 = Permission::create(['name' => 'удаление: тип акта']);
        $typeActPermission6 = Permission::create(['name' => 'восстановление: тип акта']);
        $typeActPermission7 = Permission::create(['name' => 'безвозвратное удаление: тип акта']);

        //CREATE ROLES (создание ролей)
        $userRole = Role::create(['name' => 'Эксперт'])->syncPermissions([
            $actPermission1,
            $actPermission2,
            $actPermission3,
            $actPermission4,
            $actPermission5,
            $organizationPermission1,
            $organizationPermission2,
            $organizationPermission3,
            $organizationPermission4,
            $organizationPermission5,
            $companyPermission1,
            $companyPermission2,
            $companyPermission3,
            $companyPermission4,
            $companyPermission5,
            $measurePermission1,
            $measurePermission2,
            $measurePermission3,
            $measurePermission4,
            $measurePermission5,
            $attachmentPermission1,
            $attachmentPermission2,
            $attachmentPermission3,
            $attachmentPermission4,
            $attachmentPermission5,
            $attachmentPermission6,
            $attachmentPermission7,
            $productPermission1,
            $productPermission2,
            $productPermission3,
            $productPermission4,
            $productPermission5,
            $productPermission6,
            $productPermission7,
        ]);
        $adminRole = Role::create(['name' => 'Администратор'])->syncPermissions([
            $actPermission1,
            $actPermission2,
            $actPermission3,
            $actPermission4,
            $actPermission5,
            $actPermission6,
            $actPermission7,
            $actPermission1,
            $attachmentPermission1,
            $attachmentPermission2,
            $attachmentPermission3,
            $attachmentPermission4,
            $attachmentPermission5,
            $attachmentPermission6,
            $attachmentPermission7,
            $codeGroupPermission1,
            $codeGroupPermission2,
            $codeGroupPermission3,
            $codeGroupPermission4,
            $codeGroupPermission5,
            $codeGroupPermission6,
            $codeGroupPermission7,
            $companyPermission1,
            $companyPermission2,
            $companyPermission3,
            $companyPermission4,
            $companyPermission5,
            $companyPermission6,
            $companyPermission7,
            $expertPermission1,
            $expertPermission2,
            $expertPermission3,
            $expertPermission4,
            $expertPermission5,
            $expertPermission6,
            $expertPermission7,
            $measurePermission1,
            $measurePermission2,
            $measurePermission3,
            $measurePermission4,
            $measurePermission5,
            $measurePermission6,
            $measurePermission7,
            $organizationPermission1,
            $organizationPermission2,
            $organizationPermission3,
            $organizationPermission4,
            $organizationPermission5,
            $organizationPermission6,
            $organizationPermission7,
            $positionPermission1,
            $positionPermission2,
            $positionPermission3,
            $positionPermission4,
            $positionPermission5,
            $positionPermission6,
            $positionPermission7,
            $productPermission1,
            $productPermission2,
            $productPermission3,
            $productPermission4,
            $productPermission5,
            $productPermission6,
            $productPermission7,
            $subpositionPermission1,
            $subpositionPermission2,
            $subpositionPermission3,
            $subpositionPermission4,
            $subpositionPermission5,
            $subpositionPermission6,
            $subpositionPermission7,
            $typeActPermission1,
            $typeActPermission2,
            $typeActPermission3,
            $typeActPermission4,
            $typeActPermission5,
            $typeActPermission6,
            $typeActPermission7,
        ]);

        User::create([
            'username' => 'administrator',
            'email_verified_at' => now(),
            'password' => '$2y$10$R5vBPe6dfxDQevMtpH6pmetk3B0oyACoFU7RvLkz8EhUE4u99.r.O', // password 12345678
            'remember_token' => Str::random(10),
        ])->assignRole($adminRole);
        for ($i=1; $i <2; $i++) {
            User::create([
                'username' => 'пользователь'.$i,
                'email_verified_at' => now(),
                'password' => '$2y$10$R5vBPe6dfxDQevMtpH6pmetk3B0oyACoFU7RvLkz8EhUE4u99.r.O', // password 12345678
                'remember_token' => Str::random(10),
            ])->assignRole($userRole);
        }

    }
}
