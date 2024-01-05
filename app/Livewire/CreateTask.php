<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CreateTask extends Component
{
    // Define the form fields as public properties
    public $title;
    public $body;
    public $start_time;
    public $end_time;

    // Define the validation rules as a protected array
    protected $rules = [
        'title' => 'required|string|max:255',
        'body' => 'required|string',
        'start_time' => 'required|date_format:H:i',
        'end_time' => 'required|date_format:H:i|after:start_time',
    ];

    // Define the form submission logic as a public method
    public function createTask()
    {
        // Validate the form data
        $this->validate();

        // Create a new task using the form data
        Task::create([
            'title' => $this->title,
            'body' => $this->body,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
        ]);

        // Reset the form data
        $this->reset();

        // Emit a success message
        $this->emit('saved');
    }

    // Render the create-task.blade.php view
    public function render()
    {
        return view('Livewire.create-task');
    }
}
