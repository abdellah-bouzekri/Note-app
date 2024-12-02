<?php

use App\Livewire\NoteList;
use Illuminate\Support\Facades\Route;

Route::get('/', NoteList::class);
