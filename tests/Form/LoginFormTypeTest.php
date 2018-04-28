<?php
/**
 * Created by PhpStorm.
 * User: julienbutty
 * Date: 28/04/2018
 * Time: 09:05
 */

namespace App\Tests\Form;


use App\Form\LoginFormType;
use Symfony\Component\Form\Test\TypeTestCase;

class LoginFormTypeTest extends TypeTestCase
{
    public function testFormData()
    {
        $data = [
          '_username' => 'user1',
          '_password' => 'pwd123'
        ];

        $form = $this->factory->create(LoginFormType::class);
        $form->submit($data);

        $this->assertTrue($form->isSynchronized());
        $this->assertEquals($data, $form->getData());

        $view = $form->createView();
        $children = $view->children;

        foreach (array_keys($data) as $key) {
            $this->assertArrayHasKey($key, $children);
        }
    }
}