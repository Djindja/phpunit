<?php

class CollectionTest extends  \PHPUnit_Framework_TestCase
{
    public function empty_instantiated_collection_returns_no_items()
    {
        $collection = new \App\Support\Collection;

        $this->assertEmpty($collection->get());
    }

    public function count_is_correct_for_items_passed_in()
    {
        $collection = new \App\Support\Collection([
            'one', 'two', 'three'
        ]);

        $this->assertEquals(3, $collection->count());
    }

    public function items_returned_match_items_passed_in()
    {
        $collection = new \App\Support\Collection([
            'one', 'two'
        ]);

        $this->assertCount(2, $collection->get());
        $this->assertEquals($collection->get()[0], 'one');
        $this->assertEquals($collection->get()[1], 'two');
    }

    public function collection_is_instance_of_iterator_aggregate()
    {
        $collection =  new \App\Support\Collection();

        $this->assertInstanceOf(IterationAggregate::class, $collection);
    }

    public function collection_can_be_iterated()
    {
        $collection =  new \App\Support\Collection([
            'one', 'two', 'three'
        ]);

        $items = [];

        foreach ($collection as $item) {
            $items[] = $item;
        }

        $this->assertCount(3, $items);
        $this->assertInstanceOf(ArrayIterator::class, $collection->getIterator());
    }

    public function collection_can_be_merged_with_another_collection()
    {
        $collection1 = new \App\Support\Collection(['one', 'two']);
        $collection2 = new \App\Support\Collection(['three', 'four']);

        $collection1->merge($collection2);

        $this->assertCount(5, $collection1->get());
        $this->assertEquals(5, $collection1->count());
    }

    public function can_add_to_existing_collection()
    {
        $collection = new \App\Support\Collection(['one', 'two']);
        $collection->add(['three']);

        $this->assertCount(3, $collection->get());
        $this->assertEquals(3, $collection->count());
    }

    public function returns_json_encoed_items()
    {
        $collection =  new \App\Support\Collection([
            ['username' => 'alex'],
            ['username' => 'billy']
        ]);

        $this->assertInternalType('string', $collection->toJson());
        $this->assertEquals('[{'username':'alex'},{'username':'billy'}]', $collection->toJson());
    }

    public function json_encoding_a_collection_object_returns_json()
    {
        $collection =  new \App\Support\Collection([
            ['username' => 'alex'],
            ['username' => 'billy']
        ]);

        $encoded = json_encode($collection);

        $this->assertInternalType('string', $encoded);
        $this->assertEquals('[{'username':'alex'},{'username':'billy'}]', $encoded);
    }

}
