<?php

namespace App\DataFixtures;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use App\Entity\Cake;
use App\Entity\Category;

class CakeFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $rowCakes = [
            [
                'name' => 'Chocolate Blackout Cake',
                'image' => 'http://cf.chocolatechocolateandmore.com/wp-content/uploads/2015/08/chocblackoutcake.jpg',
                'price' => '40.00',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla risus augue, suscipit id tempus et, elementum a diam. Integer rutrum bibendum turpis. Maecenas vehicula eleifend mi, eget bibendum metus laoreet eu. In hac habitasse platea dictumst. Donec placerat rutrum ligula non laoreet. Phasellus dictum in risus vel congue. Nullam tortor risus, imperdiet sed laoreet sit amet, mollis non tortor. Vestibulum est tellus, scelerisque porttitor metus pretium, ultrices pretium eros. Vestibulum maximus tortor ac odio euismod, a consequat enim blandit. Sed libero mi, auctor ac interdum vitae, gravida ac ligula. Mauris lacinia gravida malesuada. Etiam a nibh hendrerit, dictum quam sit amet, tincidunt mauris. Nullam fringilla lacinia finibus.',
            ],
            [
                'name' => 'Chocolate Raspberry Cake',
                'image' => 'http://cf.chocolatechocolateandmore.com/wp-content/uploads/2015/08/chocraspberrycake.jpg',
                'price' => '40.00',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla risus augue, suscipit id tempus et, elementum a diam. Integer rutrum bibendum turpis. Maecenas vehicula eleifend mi, eget bibendum metus laoreet eu. In hac habitasse platea dictumst. Donec placerat rutrum ligula non laoreet. Phasellus dictum in risus vel congue. Nullam tortor risus, imperdiet sed laoreet sit amet, mollis non tortor. Vestibulum est tellus, scelerisque porttitor metus pretium, ultrices pretium eros. Vestibulum maximus tortor ac odio euismod, a consequat enim blandit. Sed libero mi, auctor ac interdum vitae, gravida ac ligula. Mauris lacinia gravida malesuada. Etiam a nibh hendrerit, dictum quam sit amet, tincidunt mauris. Nullam fringilla lacinia finibus.',
            ],
            [
                'name' => 'Chocolate Coconut Cake',
                'image' => 'http://cf.chocolatechocolateandmore.com/wp-content/uploads/2015/08/choccoconutcake.jpg',
                'price' => '40.00',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla risus augue, suscipit id tempus et, elementum a diam. Integer rutrum bibendum turpis. Maecenas vehicula eleifend mi, eget bibendum metus laoreet eu. In hac habitasse platea dictumst. Donec placerat rutrum ligula non laoreet. Phasellus dictum in risus vel congue. Nullam tortor risus, imperdiet sed laoreet sit amet, mollis non tortor. Vestibulum est tellus, scelerisque porttitor metus pretium, ultrices pretium eros. Vestibulum maximus tortor ac odio euismod, a consequat enim blandit. Sed libero mi, auctor ac interdum vitae, gravida ac ligula. Mauris lacinia gravida malesuada. Etiam a nibh hendrerit, dictum quam sit amet, tincidunt mauris. Nullam fringilla lacinia finibus.',
            ],
        ];

        $rowCategories = [
            'Chocolate',
            'Raspberry',
            'Coconut',
        ];

        $categories = [];

        foreach ($rowCategories as $rowCategory) {
            $categories[] = $category = new Category();
            $category->setName($rowCategory);

            $manager->persist($category);
        }

        $cakes = [];

        foreach ($rowCakes as $rowCake) {
            $cakes[] = $cake = new Cake();
            $cake->setName($rowCake['name']);
            $cake->setImage($rowCake['image']);
            $cake->setPrice($rowCake['price']);
            $cake->setDescription($rowCake['description']);

            $manager->persist($cake);
        }

        $cakes[0]->addCategory($categories[0]);
        $cakes[1]->addCategory($categories[0]);
        $cakes[2]->addCategory($categories[0]);
        $cakes[1]->addCategory($categories[1]);
        $cakes[2]->addCategory($categories[2]);

        $manager->flush();
    }
}
