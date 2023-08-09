<?php


namespace Tests\Feature;

use App\Models\Statistic;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


class ManageUserStatisticsByAdminTest extends TestCase
{
    use RefreshDatabase;

    public function test_guests_cannot_manage_user_statistics(): void
    {
        $this->get('/admin/users/tasks/statistics')
            ->assertRedirect('/login');
    }

    public function test_only_admin_can_manage_user_statistics(): void
    {
        $user = User::factory()->create(['is_admin' => false]);

        $this->actingAs($user)->get('/admin/users/tasks/statistics')
            ->assertRedirect('home')
            ->assertSessionHas('error', 'You cannot access this section');
    }

    public function test_admin_can_view_user_statistics(): void
    {
        $user = User::factory()->create(['is_admin' => false]);

        $admin = User::factory()->create(['is_admin' => true]);

        Task::factory()->count(10)->create([
            'assigned_to_id' => $user->id,
            'assigned_by_id' => $admin->id
        ]);

       $statistic = Statistic::factory()->create([
            'user_id' => $user->id,
            'tasks_count' => 10
        ]);

       $this->actingAs($admin)->get('/admin/users/tasks/statistics')
            ->assertSee([$user->name, $statistic->tasks_count]);
    }

}
