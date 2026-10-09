<?php

namespace Tests\Feature;

use App\Models\Lead;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LeadCreationTest extends TestCase
{
    // use RefreshDatabase;

    public function test_lead_can_be_created_successfully(): void
    {
        // Generate unique data to avoid duplicate validation errors
        $email = fake()->unique()->safeEmail();
        $phone = fake()->unique()->numerify('9#########');

        $data = [
            'first_name'   => 'John',
            'last_name'    => 'Smith',
            'company_name' => 'XYZ Solutions',
            'email'        => $email,
            'phone'        => $phone,
            'status'       => 'new',
        ];

        // Submit the lead creation form
        $response = $this->from(route('leads.create'))
            ->post(route('leads.store'), $data);

        // Confirm validation succeeded
        $response->assertSessionHasNoErrors();

        // Confirm the request redirected successfully
        $response->assertRedirect();

        // Confirm the success message exists
        $response->assertSessionHas('success');

        // Verify the lead was saved
        $this->assertDatabaseHas('leads', [
            'first_name'   => 'John',
            'last_name'    => 'Smith',
            'company_name' => 'XYZ Solutions',
            'email'        => $email,
            'phone'        => $phone,
            'status'       => 'new',
        ]);

        // Retrieve the newly created lead
        $lead = Lead::where('email', $email)->firstOrFail();

        // Verify the associated contact was created
        $this->assertDatabaseHas('contacts', [
            'first_name'       => 'John',
            'last_name'        => 'Smith',
            'email'            => $email,
            'phone'            => $phone,
            'contactable_type' => 'lead',
            'contactable_id'   => $lead->id,
            'status'           => 'active',
        ]);
    }

    public function test_lead_creation_fails_with_invalid_data(): void
    {
        $data = [
            'company_name' => '',
             'first_name'   => 'John',
            'last_name'    => 'Smith',
            'email' => 'not-an-email',
            'phone' => fake()->numerify('9#########'),
        ];

        $response = $this->from(route('leads.create'))
            ->post(route('leads.store'), $data);

        // Check that validation errors were returned.
        $response->assertSessionHasErrors([
            'company_name',
            'email',
        ]);

        // Account must not be created.
        $this->assertDatabaseMissing('leads', [
            'email' => 'not-an-email',
        ]);

        // Contact must not be created either.
        $this->assertDatabaseMissing('contacts', [
            'email' => 'not-an-email',
        ]);
    }

    public function test_lead_creation_fails_with_duplicate_email(): void
    {
        // Arrange: create an existing lead.
        $existingAccount = Lead::create([
            'company_name' => 'Existing Company',
            'email' => 'existing@example.com',
            'phone' => '9876543210',
            'status' => 'new',
        ]);

        // Attempt to create another lead with the same email.
        $data = [
            'company_name' => 'Duplicate Email Company',
            'email' => $existingAccount->email,
            'phone' => fake()->numerify('9#########'),
        ];

        // Act: submit the request.
        $response = $this->from(route('leads.create'))
            ->post(route('leads.store'), $data);

        // Assert: email validation should fail.
        $response->assertSessionHasErrors(['email']);

        // The attempted account must not be created.
        $this->assertDatabaseMissing('leads', [
            'company_name' => 'Duplicate Email Company',
        ]);
    }
}
