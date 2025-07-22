<?php
declare(strict_types=1);

use Migrations\BaseMigration;

class AddAuthTokenToUsers extends BaseMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/migrations/4/en/migrations.html#the-change-method
     * @return void
     */
    public function change(): void
    {
        $table = $this->table('users')
            ->addColumn('token', 'string', [
            'default' => '' // originally null but it couldn't migrate when it was null
            ])
            ->addColumn('token_active', 'boolean', [
                'default' => false
            ])
            ->update();
    }
}
