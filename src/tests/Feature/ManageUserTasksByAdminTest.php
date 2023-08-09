<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ManageUserTasksByAdminTest extends TestCase
{
    use RefreshDatabase;

    public function test_guests_cannot_manage_tasks(): void
    {
        $task = Task::factory()->raw();

        $this->post('/admin/tasks/create', $task)
            ->assertRedirect('/login');

        $this->get('/admin/tasks/create')
            ->assertRedirect('/login');
    }

    public function test_only_admin_can_manage_user_tasks(): void
    {
        $user = User::factory()->create(['is_admin' => false]);

        $task = Task::factory()->raw();

        $this->actingAs($user)->post('/admin/tasks/create', $task)
            ->assertRedirect('home')
            ->assertSessionHas('error', 'You cannot access this section');

        $this->actingAs($user)->get('/admin/tasks/create')
            ->assertRedirect('home')
            ->assertSessionHas('error', 'You cannot access this section');
    }

    public function test_admin_can_assign_a_task_for_user(): void
    {
        $user = User::factory()->create(['is_admin' => false]);

        $admin = User::factory()->create(['is_admin' => true]);

        $response = $this->actingAs($admin)->post('/admin/tasks/create', [
            'title' => 'this is task title',
            'description' => 'this is task description',
            'assigned_to_id' => $user->id,
            'assigned_by_id' => $admin->id
        ]);

        $response->assertRedirect('/admin/users/tasks');

        $this->assertCount(1, Task::all());

        $this->assertDatabaseHas('tasks', [
            'title' => 'this is task title',
            'description' => 'this is task description',
            'assigned_to_id' => $user->id,
            'assigned_by_id' => $admin->id
        ]);
    }

    public function test_only_admin_can_assign_a_task_for_user(): void
    {
        $user = User::factory()->create(['is_admin' => false]);

        $admin = User::factory()->create(['is_admin' => true]);

        $response = $this->actingAs($admin)->post('/admin/tasks/create', [
            'title' => 'this is task title',
            'description' => 'this is task description',
            'assigned_to_id' => $admin->id,
            'assigned_by_id' => $user->id
        ]);

        $response->assertSessionHasErrors(['assigned_by_id']);

        $this->assertCount(0, Task::all());
    }

    public function test_admin_can_view_task_creation_page(): void
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create(['is_admin' => false]);
        $admin = User::factory()->create(['is_admin' => true]);

        $response = $this->actingAs($admin)->get('/admin/tasks/create');

        $response->assertSee([$admin->name, $user->name, $user->id, $admin->id]);
    }

    public function test_admin_can_view_task_list_of_users_tasks(): void
    {
        $this->withoutExceptionHandling();

        $task = Task::factory()->create();

        $admin = User::factory()->create(['is_admin' => true]);

        $response = $this->actingAs($admin)->get('/admin/users/tasks');

        $response->assertSee([$task->title, $task->description]);
    }

    public function test_a_task_requires_a_title(): void
    {
        $user = User::factory()->create(['is_admin' => false]);
        $admin = User::factory()->create(['is_admin' => true]);

        $response = $this->actingAs($admin)->post('/admin/tasks/create', [
            'title' => '',
            'description' => 'this is task description',
            'assigned_to_id' => $user->id,
            'assigned_by_id' => $admin->id
        ]);

        $response->assertSessionHasErrors(['title']);

        $this->assertCount(0, Task::all());
    }

    public function test_a_task_requires_a_description(): void
    {
        $user = User::factory()->create(['is_admin' => false]);
        $admin = User::factory()->create(['is_admin' => true]);

        $response = $this->actingAs($admin)->post('/admin/tasks/create', [
            'title' => 'this is title',
            'description' => '',
            'assigned_to_id' => $user->id,
            'assigned_by_id' => $admin->id
        ]);

        $response->assertSessionHasErrors(['description']);

        $this->assertCount(0, Task::all());
    }

    public function test_a_task_requires_a_assigned_by_id(): void
    {
        $user = User::factory()->create(['is_admin' => false]);
        $admin = User::factory()->create(['is_admin' => true]);

        $response = $this->actingAs($admin)->post('/admin/tasks/create', [
            'title' => 'this is title',
            'description' => 'this is description',
            'assigned_to_id' => $user->id,
            'assigned_by_id' => null
        ]);

        $response->assertSessionHasErrors(['assigned_by_id']);

        $this->assertCount(0, Task::all());
    }

    public function test_a_task_requires_a_assigned_to_id(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);

        $response = $this->actingAs($admin)->post('/admin/tasks/create', [
            'title' => 'this is title',
            'description' => 'this is description',
            'assigned_to_id' => null,
            'assigned_by_id' => $admin->id
        ]);

        $response->assertSessionHasErrors(['assigned_to_id']);

        $this->assertCount(0, Task::all());
    }

}
