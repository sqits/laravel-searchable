<?php

namespace Sqits\Searchable\Tests;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Sqits\Searchable\Tests\Models\Framework;
use Sqits\Searchable\Tests\Models\Package;

abstract class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function getPackageProviders($app)
    {
        return ['Sqits\Searchable\SearchableServiceProvider'];
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->setUpDatabase();
    }

    protected function setUpDatabase()
    {
        Schema::create('frameworks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('description')->nullable();

            $table->timestamps();
        });

        Schema::create('packages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('framework_id');
            $table->foreign('framework_id')->references('id')->on('frameworks');
            $table->string('name');
            $table->string('description');

            $table->timestamps();
        });

        $framework = Framework::create([
            'name' => 'Laravel',
            'description' => 'The PHP Framework for Web Artisans',
        ]);

        Package::create([
            'framework_id' => $framework->id,
            'name' => 'laravel-searchable',
            'description' => 'Package to add an easy way to add a basic search functionality to your models'
        ]);
    }
}
