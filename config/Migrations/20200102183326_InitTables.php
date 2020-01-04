<?php
use Migrations\AbstractMigration;

class InitTables extends AbstractMigration
{
    public function up()
    {

        $this->table('class_details', ['id' => false, 'primary_key' => ['idCLASS']])
            ->addColumn('idCLASS', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('TIME_LEARN', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('ADDRESS LEARN', 'string', [
                'default' => null,
                'limit' => 200,
                'null' => true,
            ])
            ->addColumn('ROOM_NUMBER', 'string', [
                'default' => null,
                'limit' => 3,
                'null' => true,
            ])
            ->addColumn('MAX SEATS', 'string', [
                'default' => null,
                'limit' => 100,
                'null' => true,
            ])
            ->addColumn('REMARK', 'string', [
                'default' => null,
                'limit' => 300,
                'null' => true,
            ])
            ->create();

        $this->table('class_students', ['id' => false])
            ->addColumn('idCLASS', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('idSTUDENT', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('REGISTER DATE', 'string', [
                'default' => null,
                'limit' => 45,
                'null' => true,
            ])
            ->addColumn('TOTAL_FEE', 'string', [
                'default' => null,
                'limit' => 45,
                'null' => true,
            ])
            ->addColumn('REMARK', 'string', [
                'default' => null,
                'limit' => 45,
                'null' => true,
            ])
            ->addColumn('UPDATE_TIME', 'string', [
                'default' => null,
                'limit' => 45,
                'null' => true,
            ])
            ->addIndex(
                [
                    'idCLASS',
                ]
            )
            ->addIndex(
                [
                    'idSTUDENT',
                ]
            )
            ->create();

        $this->table('classes', ['id' => false, 'primary_key' => ['idCLASS']])
            ->addColumn('idCLASS', 'integer', [
                'autoIncrement' => true,
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('idTEACHER', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('idCOURSE', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('NAME', 'string', [
                'default' => null,
                'limit' => 200,
                'null' => true,
            ])
            ->addColumn('DESCRIPTION', 'string', [
                'default' => null,
                'limit' => 200,
                'null' => true,
            ])
            ->addColumn('UPDATE_TIME', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addIndex(
                [
                    'idCOURSE',
                ]
            )
            ->addIndex(
                [
                    'idTEACHER',
                ]
            )
            ->create();

        $this->table('courses', ['id' => false, 'primary_key' => ['idCOURSE']])
            ->addColumn('idCOURSE', 'integer', [
                'autoIncrement' => true,
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('COURSE_INFO', 'string', [
                'default' => null,
                'limit' => 300,
                'null' => true,
            ])
            ->addColumn('YAER_COURSE', 'string', [
                'default' => null,
                'limit' => 2,
                'null' => true,
            ])
            ->addColumn('DESCRIPTION', 'string', [
                'default' => null,
                'limit' => 300,
                'null' => false,
            ])
            ->addColumn('UPDATE_TIME', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->create();

        $this->table('fee_students', ['id' => false, 'primary_key' => ['idFEE_STUDENT']])
            ->addColumn('idFEE_STUDENT', 'integer', [
                'autoIncrement' => true,
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('idCLASS_STUDENT', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('AMONUT', 'string', [
                'default' => null,
                'limit' => 12,
                'null' => true,
            ])
            ->addColumn('TIME_PAID', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('REMARK', 'string', [
                'default' => null,
                'limit' => 300,
                'null' => true,
            ])
            ->addColumn('UPDATE__TIME', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addIndex(
                [
                    'idCLASS_STUDENT',
                ]
            )
            ->create();

        $this->table('genders', ['id' => false, 'primary_key' => ['idGENDER']])
            ->addColumn('idGENDER', 'integer', [
                'autoIncrement' => true,
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('NAME', 'string', [
                'default' => null,
                'limit' => 10,
                'null' => true,
            ])
            ->create();

        $this->table('sessions', ['id' => false, 'primary_key' => ['id']])
            ->addColumn('id', 'string', [
                'default' => null,
                'limit' => 40,
                'null' => false,
            ])
            ->addColumn('created', 'datetime', [
                'default' => 'CURRENT_TIMESTAMP',
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => 'CURRENT_TIMESTAMP',
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('data', 'binary', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('expires', 'integer', [
                'default' => null,
                'limit' => 10,
                'null' => true,
                'signed' => false,
            ])
            ->create();

        $this->table('students', ['id' => false, 'primary_key' => ['idSTUDENT']])
            ->addColumn('idSTUDENT', 'integer', [
                'autoIncrement' => true,
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('idGENDER', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('NAME', 'string', [
                'default' => null,
                'limit' => 200,
                'null' => true,
            ])
            ->addColumn('BIRTHDAY', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('PHONE', 'string', [
                'default' => null,
                'limit' => 13,
                'null' => true,
            ])
            ->addColumn('ADDRESS', 'string', [
                'default' => null,
                'limit' => 300,
                'null' => true,
            ])
            ->addColumn('REMARK', 'string', [
                'default' => null,
                'limit' => 300,
                'null' => true,
            ])
            ->addColumn('IMAGE', 'string', [
                'default' => null,
                'limit' => 300,
                'null' => true,
            ])
            ->addColumn('UPDATE_TIME', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addIndex(
                [
                    'idGENDER',
                ]
            )
            ->create();

        $this->table('teachers', ['id' => false, 'primary_key' => ['idTEACHER']])
            ->addColumn('idTEACHER', 'integer', [
                'autoIncrement' => true,
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('NAME', 'string', [
                'default' => null,
                'limit' => 200,
                'null' => true,
            ])
            ->addColumn('BIRTHDAY', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('PHONE', 'string', [
                'default' => null,
                'limit' => 13,
                'null' => true,
            ])
            ->addColumn('YEAR_EXPERIENCE', 'string', [
                'default' => null,
                'limit' => 2,
                'null' => true,
            ])
            ->addColumn('ADDRESS', 'string', [
                'default' => null,
                'limit' => 300,
                'null' => true,
            ])
            ->addColumn('REMARK', 'string', [
                'default' => null,
                'limit' => 300,
                'null' => true,
            ])
            ->addColumn('UPDATE_TIME', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('ID_GENDER', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addIndex(
                [
                    'ID_GENDER',
                ]
            )
            ->create();

        $this->table('users', ['id' => false, 'primary_key' => ['idUSER']])
            ->addColumn('idUSER', 'integer', [
                'autoIncrement' => true,
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('USERNAME', 'string', [
                'default' => null,
                'limit' => 200,
                'null' => true,
            ])
            ->addColumn('PASSWORD', 'string', [
                'default' => null,
                'limit' => 45,
                'null' => true,
            ])
            ->addColumn('ROLE', 'string', [
                'default' => null,
                'limit' => 45,
                'null' => true,
            ])
            ->addColumn('CREATED', 'string', [
                'default' => null,
                'limit' => 45,
                'null' => true,
            ])
            ->addColumn('MODIFIED', 'string', [
                'default' => null,
                'limit' => 45,
                'null' => true,
            ])
            ->create();

        $this->table('class_details')
            ->addForeignKey(
                'idCLASS',
                'classes',
                'idCLASS',
                [
                    'update' => 'NO_ACTION',
                    'delete' => 'NO_ACTION'
                ]
            )
            ->update();

        $this->table('class_students')
            ->addForeignKey(
                'idCLASS',
                'classes',
                'idCLASS',
                [
                    'update' => 'NO_ACTION',
                    'delete' => 'NO_ACTION'
                ]
            )
            ->addForeignKey(
                'idSTUDENT',
                'students',
                'idSTUDENT',
                [
                    'update' => 'NO_ACTION',
                    'delete' => 'NO_ACTION'
                ]
            )
            ->update();

        $this->table('classes')
            ->addForeignKey(
                'idCOURSE',
                'courses',
                'idCOURSE',
                [
                    'update' => 'NO_ACTION',
                    'delete' => 'NO_ACTION'
                ]
            )
            ->addForeignKey(
                'idTEACHER',
                'teachers',
                'idTEACHER',
                [
                    'update' => 'NO_ACTION',
                    'delete' => 'NO_ACTION'
                ]
            )
            ->update();

        $this->table('fee_students')
            ->addForeignKey(
                'idCLASS_STUDENT',
                'class_students',
                'idCLASS',
                [
                    'update' => 'NO_ACTION',
                    'delete' => 'NO_ACTION'
                ]
            )
            ->update();

        $this->table('students')
            ->addForeignKey(
                'idGENDER',
                'genders',
                'idGENDER',
                [
                    'update' => 'NO_ACTION',
                    'delete' => 'NO_ACTION'
                ]
            )
            ->update();

        $this->table('teachers')
            ->addForeignKey(
                'ID_GENDER',
                'genders',
                'idGENDER',
                [
                    'update' => 'NO_ACTION',
                    'delete' => 'NO_ACTION'
                ]
            )
            ->update();
    }

    public function down()
    {
        $this->table('class_details')
            ->dropForeignKey(
                'idCLASS'
            )->save();

        $this->table('class_students')
            ->dropForeignKey(
                'idCLASS'
            )
            ->dropForeignKey(
                'idSTUDENT'
            )->save();

        $this->table('classes')
            ->dropForeignKey(
                'idCOURSE'
            )
            ->dropForeignKey(
                'idTEACHER'
            )->save();

        $this->table('fee_students')
            ->dropForeignKey(
                'idCLASS_STUDENT'
            )->save();

        $this->table('students')
            ->dropForeignKey(
                'idGENDER'
            )->save();

        $this->table('teachers')
            ->dropForeignKey(
                'ID_GENDER'
            )->save();

        $this->table('class_details')->drop()->save();
        $this->table('class_students')->drop()->save();
        $this->table('classes')->drop()->save();
        $this->table('courses')->drop()->save();
        $this->table('fee_students')->drop()->save();
        $this->table('genders')->drop()->save();
        $this->table('sessions')->drop()->save();
        $this->table('students')->drop()->save();
        $this->table('teachers')->drop()->save();
        $this->table('users')->drop()->save();
    }
}
