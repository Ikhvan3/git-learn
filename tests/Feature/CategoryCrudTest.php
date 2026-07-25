<?php

namespace Tests\Feature;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_categories_can_be_listed(): void
    {
        Category::factory()
            ->count(3)
            ->create();

        $response = $this->getJson('/api/categories');

        $response
            ->assertOk()
            ->assertJsonCount(3, 'data');
    }

    public function test_category_can_be_created(): void
    {
        $payload = [
            'name' => 'Mobile Development',
            'slug' => 'mobile-development',
            'description' => 'Kategori pengembangan aplikasi mobile.',
        ];

        $response = $this->postJson('/api/categories', $payload);

        $response
            ->assertCreated()
            ->assertJsonPath('data.name', 'Mobile Development')
            ->assertJsonPath('data.slug', 'mobile-development');

        $this->assertDatabaseHas('categories', [
            'name' => 'Mobile Development',
            'slug' => 'mobile-development',
        ]);
    }

    public function test_duplicate_category_is_rejected(): void
    {
        Category::factory()->create([
            'name' => 'Web Development',
            'slug' => 'web-development',
        ]);

        $response = $this->postJson('/api/categories', [
            'name' => 'Web Development',
            'slug' => 'web-development',
            'description' => 'Duplicate category.',
        ]);

        $response
            ->assertUnprocessable()
            ->assertJsonValidationErrors([
                'name',
                'slug',
            ]);

        $this->assertDatabaseCount('categories', 1);
    }

    public function test_category_can_be_updated(): void
    {
        $category = Category::factory()->create([
            'name' => 'Old Category',
            'slug' => 'old-category',
        ]);

        $response = $this->putJson(
            "/api/categories/{$category->id}",
            [
                'name' => 'Updated Category',
                'slug' => 'updated-category',
                'description' => 'Updated description.',
            ]
        );

        $response
            ->assertOk()
            ->assertJsonPath('data.name', 'Updated Category')
            ->assertJsonPath('data.slug', 'updated-category');

        $this->assertDatabaseHas('categories', [
            'id' => $category->id,
            'name' => 'Updated Category',
            'slug' => 'updated-category',
        ]);

        $this->assertDatabaseMissing('categories', [
            'id' => $category->id,
            'slug' => 'old-category',
        ]);
    }

    public function test_category_can_be_deleted(): void
    {
        $category = Category::factory()->create();

        $response = $this->deleteJson(
            "/api/categories/{$category->id}"
        );

        $response->assertNoContent();

        $this->assertDatabaseMissing('categories', [
            'id' => $category->id,
        ]);
    }
}
