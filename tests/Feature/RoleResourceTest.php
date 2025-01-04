<?php

declare(strict_types=1);

namespace Feature;

use Tests\TestCase;

class RoleResourceTest extends TestCase
{
    public function test_index_returns_successful_response(): void
    {
        $this->get('/api/v1/public/terms/roles')->assertStatus(200);
    }

    public function test_index_returns_json_header(): void
    {
        $this->get('/api/v1/public/terms/roles')->assertHeader('Content-Type', 'application/json');
    }

    public function test_index_returns_a_correct_json_structure(): void
    {
        $this->get('/api/v1/public/terms/roles')->assertJsonStructure([
            'data' => [
                '*' => [
                    'name',
                    'value',
                ],
            ],
        ]);
    }

    public function test_show_returns_successful_response(): void
    {
        $this->get('/api/v1/public/terms/roles/1')->assertStatus(200);
    }

    public function test_show_returns_json_header(): void
    {
        $this->get('/api/v1/public/terms/roles/1')->assertHeader('Content-Type', 'application/json');
    }


    public function test_show_returns_a_correct_json_structure(): void
    {
        $this->get('/api/v1/public/terms/roles/1')->assertJsonStructure([
            'data' => [
                'name',
                'value',
            ],
        ]);
    }

    public function test_show_returns_404_when_given_not_exists_value(): void
    {
        $this->get('/api/v1/public/terms/roles/0')->assertStatus(404);
    }

    public function test_show_returns_404_when_given_incorrect_value(): void
    {
        $this->get('/api/v1/public/terms/roles/incorrect-string-value')->assertStatus(404);
    }
}
