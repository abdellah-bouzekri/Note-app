<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-12">
            <div class="my-5">
                <h1 class="text-bg-light spinner-border-sm rounded text-center text-success p-3">Note App</h1>
                
                <div class="row">
                    <!-- Notes Column (Left Side) -->
                    <div class="col-md-6">
                        <div class="card mb-4">
                            <div class="text-white card-header bg-dark">
                                <h5 class="mb-0">Your Notes</h5>
                            </div>
                            <div class="card-body">
                                <ul class="list-group">
                                    @foreach ($notes as $note)
                                        <li wire:key="{{ $note->id }}" class="list-group-item d-flex justify-content-between align-items-center">
                                            <!-- Note Body -->
                                            <p class="mb-0 {{ $note->done ? 'text-decoration-line-through' : '' }}">
                                                {{ $note->body }}
                                            </p>
                                            
                                            <!-- Dropdown for each note -->
                                            <div class="dropdown">
                                                <!-- Three dots icon -->
                                                <button class="btn p-0 border-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </button>
                                                
                                                <!-- Dropdown menu -->
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li>
                                                        <button class="dropdown-item text-danger" type="button" wire:confirm="Are you sure you want to delete this post?" wire:click="noteDelete({{ $note->id }})">
                                                            <i class="fas fa-trash-alt me-2"></i>Delete
                                                        </button>
                                                    </li>
                                                    <li>
                                                        <button class="dropdown-item text-primary" type="button" wire:click="editNote({{ $note->id }})">
                                                            <i class="fas fa-edit me-2"></i>Update
                                                        </button>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="d-flex justify-content-center p-4">
                                {{ $notes->links() }}
                            </div>
                        </div>
                    </div>

                    <!-- Text Area Column (Right Side) -->
                    <div class="col-md-6">
                        <div class="card">
                            <div class="text-white card-header bg-dark">
                                <h5 class="mb-0">Create a New Note</h5>
                            </div>
                            <div class="card-body">
                                <form>
                                    <div class="form-group">
                                        <textarea 
                                            name="body"  
                                            wire:model="body"
                                            class="form-control @error('body' ) is-invalid @enderror"
                                            placeholder="Start typing..."
                                            rows="6"></textarea>
                                            @error('body')
                                                <p class="invalid-feedback">
                                                    {{ $message}}
                                                </p>
                                            @enderror
                                    </div>
                                    <div class="mt-3 d-flex justify-content-end">
                                        @if ($updating)
                                            <!-- Only show Mark as Done button if the current note is not already done -->
                                            @if (!$noteToUpdate->done)
                                                <button 
                                                    class="btn btn-sm btn-success me-2" 
                                                    wire:click="noteDone" 
                                                    type="button">
                                                    <i class="fas fa-check-circle me-2"></i> Mark as Done
                                                </button>
                                            @endif
                                            <button 
                                                type="button" 
                                                class="btn btn-dark m-auto" 
                                                wire:click="cleardata">
                                                <i class="fas fa-arrow-left me-2"></i>
                                            </button>
                                            
                                            <button 
                                                type="button" 
                                                class="btn btn-primary" 
                                                wire:click="updateNote">
                                                Update
                                            </button>
                                        @else
                                            <button 
                                                type="button" 
                                                class="btn btn-dark" 
                                                wire:click="saveNote">
                                                Add
                                            </button>
                                        @endif
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>