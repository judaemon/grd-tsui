<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Log;
use Livewire\Component;

class SearchUsers extends Component
{
  // Properties
  public $label = 'Users';
  public $model;
  public bool $isMultiple = false;
  public $users = [];
  public $selectedUsers = [];

  public $query = '';

  // Methods
  public $onChangeMethod;

  public function updatedQuery()
  {
    $this->getUsers();
  }

  public function mount(
    $onChangeMethod = null,
    $model = null,
    $isMultiple = false
  ) {
    $this->getUsers();
    $this->onChangeMethod = $onChangeMethod;
    $this->model = $model;
    $this->isMultiple = $isMultiple;
  }

  public function getUsers()
  {
    $this->users = \App\Models\User::where('name', 'like', '%' . $this->query . '%')
      ->orWhere('email', 'like', '%' . $this->query . '%')
      ->get();
  }

  public function onSelectOption($value)
  {
    if ($this->isMultiple) {
      if (!collect($this->selectedUsers)->contains('id', $value['id'])) {
        $this->selectedUsers[] = $value;
      } else {
        $this->selectedUsers = collect($this->selectedUsers)
          ->reject(fn($user) => $user['id'] === $value['id'])
          ->values()
          ->toArray();
      }
    } else {
      $this->selectedUsers = [$value];
    }
  }

  public function onRemoveOption($value)
  {
    if (($key = array_search($value, $this->selectedUsers)) !== false) {
      unset($this->selectedUsers[$key]);
    }
  }

  public function render()
  {
    return view('livewire.search-users');
  }
}
