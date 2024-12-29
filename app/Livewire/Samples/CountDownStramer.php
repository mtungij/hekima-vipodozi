<?php

namespace App\Livewire\Samples;

use Livewire\Attributes\Layout;
use Livewire\Component;

class CountDownStramer extends Component
{
    public $start = 3;
    public function begin()
    {
        while ($this->start >= 0) {
            // Stream the current count to the browser...
            $this->stream(
            to: 'count',
            content: $this->start,
            replace: true,);
            // Pause for 1 second between numbers...
            sleep(1);
            // Decrement the counter...
            $this->start = $this->start - 1;
        };
    }
    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.samples.count-down-stramer');
    }
}
