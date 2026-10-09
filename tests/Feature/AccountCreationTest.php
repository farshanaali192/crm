<?php

namespace Tests\Feature;

use App\Models\Account;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AccountCreationTest extends TestCase
{
      // use RefreshDatabase;
    public function test_account_can_be_created_successfully(): void
    {
        // Generate unique test data to avoid duplicate validation errors
        $email = fake()->unique()->safeEmail();
        $phone = fake()->unique()->numerify('9#########');

        $data = [
            'company_name' => 'ABC Technologies',
            'first_name'   => 'John',
            'last_name'    => 'Smith',
            'email' => $email,
            'phone' => $phone,
        ];

        // Submit the form from the account creation page
        $response = $this->from(route('accounts.create'))
            ->post(route('accounts.store'), $data);

        // Verify that validation passed
        $response->assertSessionHasNoErrors();

        // Verify the redirect
           $response->assertRedirect();

        // Verify the success message
        $response->assertSessionHas(
            'success',
            'Account added successfully'
        );

        // Verify that the account was saved
        $this->assertDatabaseHas('accounts', [
            'company_name' => 'ABC Technologies',
            'email' => $email,
            'phone' => $phone,
            'status' => 'active',
        ]);

        // Retrieve the newly created account
        $account = Account::where('email', $email)
            ->firstOrFail();

        // Verify that a contact was created for the account
        $this->assertDatabaseHas('contacts', [
            'email' => $email,
            'contactable_type' => 'account',
            'contactable_id' => $account->id,
            'status' => 'active',
        ]);
    }

    public function test_account_creation_fails_with_invalid_data(): void
    {
        $data = [
            'company_name' => '',
             'first_name'   => 'John',
            'last_name'    => 'Smith',
            'email' => 'not-an-email',
            'phone' => fake()->numerify('9#########'),
        ];

        $response = $this->from(route('accounts.create'))
            ->post(route('accounts.store'), $data);

        // Check that validation errors were returned.
        $response->assertSessionHasErrors([
            'company_name',
            'email',
        ]);

        // Account must not be created.
        $this->assertDatabaseMissing('accounts', [
            'email' => 'not-an-email',
        ]);

        // Contact must not be created either.
        $this->assertDatabaseMissing('contacts', [
            'email' => 'not-an-email',
        ]);
    }

    public function test_account_creation_fails_with_duplicate_email(): void
    {
        // Arrange: create an existing account.
        $existingAccount = Account::create([
            'company_name' => 'Existing Company',
            'email' => 'existing@example.com',
            'phone' => '9876543210',
            'status' => 'active',
        ]);

        // Attempt to create another account with the same email.
        $data = [
            'company_name' => 'Duplicate Email Company',
            'email' => $existingAccount->email,
            'phone' => fake()->numerify('9#########'),
        ];

        // Act: submit the request.
        $response = $this->from(route('accounts.create'))
            ->post(route('accounts.store'), $data);

        // Assert: email validation should fail.
        $response->assertSessionHasErrors(['email']);

        // The attempted account must not be created.
        $this->assertDatabaseMissing('accounts', [
            'company_name' => 'Duplicate Email Company',
        ]);
    }
}
