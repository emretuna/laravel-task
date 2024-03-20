<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Carbon;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\EventController
 */
final class EventControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $events = Event::factory()->count(3)->create();

        $response = $this->get(route('events.index'));

        $response->assertOk();
        $response->assertViewIs('event.index');
        $response->assertViewHas('events');
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('events.create'));

        $response->assertOk();
        $response->assertViewIs('event.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\EventController::class,
            'store',
            \App\Http\Requests\EventStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $title = $this->faker->sentence(4);
        $content = $this->faker->paragraphs(3, true);
        $start = Carbon::parse($this->faker->dateTime());
        $end = Carbon::parse($this->faker->dateTime());
        $user = User::factory()->create();

        $response = $this->post(route('events.store'), [
            'title' => $title,
            'content' => $content,
            'start' => $start->toDateTimeString(),
            'end' => $end->toDateTimeString(),
            'user_id' => $user->id,
        ]);

        $events = Event::query()
            ->where('title', $title)
            ->where('content', $content)
            ->where('start', $start)
            ->where('end', $end)
            ->where('user_id', $user->id)
            ->get();
        $this->assertCount(1, $events);
        $event = $events->first();

        $response->assertRedirect(route('events.index'));
        $response->assertSessionHas('event.id', $event->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $event = Event::factory()->create();

        $response = $this->get(route('events.show', $event));

        $response->assertOk();
        $response->assertViewIs('event.show');
        $response->assertViewHas('event');
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $event = Event::factory()->create();

        $response = $this->get(route('events.edit', $event));

        $response->assertOk();
        $response->assertViewIs('event.edit');
        $response->assertViewHas('event');
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\EventController::class,
            'update',
            \App\Http\Requests\EventUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $event = Event::factory()->create();
        $title = $this->faker->sentence(4);
        $content = $this->faker->paragraphs(3, true);
        $start = Carbon::parse($this->faker->dateTime());
        $end = Carbon::parse($this->faker->dateTime());
        $user = User::factory()->create();

        $response = $this->put(route('events.update', $event), [
            'title' => $title,
            'content' => $content,
            'start' => $start->toDateTimeString(),
            'end' => $end->toDateTimeString(),
            'user_id' => $user->id,
        ]);

        $event->refresh();

        $response->assertRedirect(route('events.index'));
        $response->assertSessionHas('event.id', $event->id);

        $this->assertEquals($title, $event->title);
        $this->assertEquals($content, $event->content);
        $this->assertEquals($start, $event->start);
        $this->assertEquals($end, $event->end);
        $this->assertEquals($user->id, $event->user_id);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $event = Event::factory()->create();

        $response = $this->delete(route('events.destroy', $event));

        $response->assertRedirect(route('events.index'));

        $this->assertModelMissing($event);
    }
}
