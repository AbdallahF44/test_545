<?php

namespace App\Http\Livewire\Colors;

use App\Models\Color;
use App\Models\Color_Product;
use Livewire\Component;

class Index extends Component
{
    public $name;
    public $hex;
    public $edit_color_name;
    public $color_id;
    public $lang='en';

    protected $rules = [
        'name' => 'required|min:2',
        'hex' => 'required',
    ];

    public function updated($property)
    {
        $this->validateOnly($property);
    }

    public function store()
    {
        $this->validate();
        Color::create([
            'name' => $this->name,
            'hex' => $this->hex,
        ]);
        $this->reset();
        toastr()->success("Color Successfully Added.");
        $this->dispatchBrowserEvent('close-modal');
//        return redirect()->to('/comments');
    }

    public function edit($id)
    {
        $color = Color::findorFail($id);
        $this->color_id = $id;
        $this->edit_color_name = $color->name;
        $this->name = $color->name;
        $this->hex = $color->hex;
    }

    public function update()
    {
        $this->validate();
        $color = Color::find($this->color_id);
        $color->update([
            'name' => $this->name,
            'hex' => $this->hex,
        ]);
        toastr()->success('Color successfully Updated.');
        $this->reset();

        $this->dispatchBrowserEvent('close-modal');
//        return redirect()->to('/comments');
    }

    public function delete($id)
    {
        $color = Color::findorFail($id);
        $this->color_id = $id;
        $this->name = $color->name;
        $this->hex = $color->hex;
    }

    public function destroy()
    {
        Color::destroy($this->color_id);
        Color_Product::where('color_id', $this->color_id)->delete();
        $this->reset();
        toastr()->success('Color successfully Deleted.');
        $this->dispatchBrowserEvent('close-modal');
//        return redirect()->to('/comments');
    }

    public function render()
    {
        $colors = Color::all();
        return view('livewire.colors.index', ['colors' => $colors])->layout('colors.all');
    }
}
