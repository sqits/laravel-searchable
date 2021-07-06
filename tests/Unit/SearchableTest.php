<?php

namespace Sqits\Searchable\Tests\Unit;

use Illuminate\Http\Request;
use Sqits\Searchable\Tests\Models\Framework;
use Sqits\Searchable\Tests\Models\Package;
use Sqits\Searchable\Tests\TestCase;

class SearchableTest extends TestCase
{
    /**
     * Test if a search on a simple field of the model can be performed.
     *
     * @test
     * @return void
     */
    public function it_can_search_in_a_simple_field(): void
    {
        $request = new Request();

        $request->merge([
            'search' => [
                'name' => 'lara',
            ],
        ]);

        $framework = Framework::searchable($request)->first();

        $this->assertEquals('Laravel', $framework->name);
    }

    /**
     * Test if a search on a combined field of the model can be performed.
     *
     * @test
     * @return void
     */
    public function it_can_search_in_a_combined_field(): void
    {
        $request = new Request();

        $request->merge([
            'search' => [
                'combined' => 'artisans',
            ],
        ]);

        $framework = Framework::searchable($request)->first();

        $this->assertEquals('Laravel', $framework->name);
        $this->assertEquals('The PHP Framework for Web Artisans', $framework->description);
    }

//    /**
//     * Test if a search on a simple field of the model can be performed
//     *
//     * @test
//     * @return void
//     */
//    public function it_can_search_in_a_simple_field_in_a_relationship() : void
//    {
//        $request = new Request();
//
//        $request->merge([
//            'search' => [
//                'packages' => [
//                    'name' => 'searchable'
//                ]
//            ]
//        ]);
//
//        $framework = Framework::searchable($request)->first();
//
//        dd($framework);
//
//        $this->assertEquals('Laravel', $framework->name);
//        $this->assertEquals('laravel-searchable', $framework->packages->first()->name);
//    }

//    /**
//     * Test if a search on a combined field of an relationship of the model can be performed
//     *
//     * @test
//     * @return void
//     */
//    public function it_can_search_in_a_combined_field_in_a_relationship() : void
//    {
//        $request = new Request();
//
//        $request->merge([
//            'search' => [
//                'packages' => [
//                    'combined' => 'asfa'
//                ]
//            ]
//        ]);
//
//        $framework = Framework::searchable($request)->first();
//
//        dd($framework);
//
//        $this->assertEquals('Laravel', $framework->name);
//        $this->assertEquals('Package to add an easy way to add a basic search functionality to your models', $framework->packages->first()->description);
//    }
}
