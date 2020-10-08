<?php

namespace Tests\Unit;

use App\Models\Form;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FormTest extends TestCase
{
    use DatabaseMigrations, RefreshDatabase;

    /**
     * @test Can i store new form
     *
     * @return void
     */
    public function canIStoreNewFormData()
    {
        $form = Form::factory()->make()->toArray();
        $response = $this->post(route('forms.store'), $form);
        $response->assertStatus(204);
        $response->assertSessionDoesntHaveErrors();
        $this->assertDatabaseHas('forms', ['page_uid' => $form['page_uid']]);
        $this->assertNotEmpty(Form::all());
    }

    /**
     * @test Can i see all forms
     *
     * @return void
     *
     * @throws \Throwable
     */
    public function canIViewAllFormsData()
    {
        Form::factory()->count(10)->create();
        $response = $this->get(route('forms.index'));
        $response->assertStatus(200);
        $this->assertNotEmpty($response->decodeResponseJson());
    }

    /**
     * @test Can i see exact form
     *
     * @return void
     *
     * @throws \Throwable
     */
    public function canIViewExactFormData()
    {
        $form = Form::factory()->create();
        $response = $this->get(route('forms.show', $form->id));
        $response->assertStatus(200);
        $this->assertNotEmpty($response->decodeResponseJson());
    }

    /**
     * @test Can i create form with invalid page_uid
     *
     * @return void
     */
    public function canICreateFormWithInvalidUid()
    {
        $form = Form::factory()->make([
            'page_uid' => '12344'
        ])->toArray();
        $response = $this->post(route('forms.store'), $form);
        $response->assertStatus(302);
        $response->assertSessionHasErrors('page_uid');
        $this->assertDatabaseMissing('forms', ['page_uid' => $form['page_uid']]);
        $this->assertEmpty(Form::all());
    }

    /**
     * @test Can i create form with invalid email
     *
     * @return void
     */
    public function canICreateFormWithInvalidEmail()
    {
        $form = Form::factory()->make([
            'email' => 'test123'
        ])->toArray();
        $response = $this->post(route('forms.store'), $form);
        $response->assertStatus(302);
        $response->assertSessionHasErrors('email');
        $this->assertDatabaseMissing('forms', ['email' => $form['email']]);
        $this->assertEmpty(Form::all());
    }

    /**
     * @test Can i create form with invalid name
     *
     * @return void
     */
    public function canICreateFormWithInvalidName()
    {
        $form = Form::factory()->make([
            'name' => 'io'
        ])->toArray();
        $response = $this->post(route('forms.store'), $form);
        $response->assertStatus(302);
        $response->assertSessionHasErrors('name');
        $this->assertDatabaseMissing('forms', ['name' => $form['name']]);
        $this->assertEmpty(Form::all());
    }

    /**
     * @test Can i create form with invalid phone
     *
     * @return void
     */
    public function canICreateFormWithInvalidPhone()
    {
        $form = Form::factory()->make([
            'phone' => '+12345'
        ])->toArray();
        $response = $this->post(route('forms.store'), $form);
        $response->assertStatus(302);
        $response->assertSessionHasErrors('phone');
        $this->assertDatabaseMissing('forms', ['phone' => $form['phone']]);
        $this->assertEmpty(Form::all());
    }

    /**
     * @test Can i create form with existing page_uid
     *
     * @return void
     */
    public function canICreateFormWithTheSameUid()
    {
        $firstForm = Form::factory()->create();
        $secondForm = Form::factory()->make([
            'page_uid' => $firstForm->page_uid
        ])->toArray();
        $response = $this->post(route('forms.store'), $secondForm);
        $response->assertStatus(302);
        $response->assertSessionHasErrors('page_uid');
        $this->assertDatabaseMissing('forms', ['phone' => $secondForm['phone']]);
    }
}
