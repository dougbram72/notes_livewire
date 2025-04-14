<div>


<flux:modal name="edit-note" class="md:w-900">
    <div class="space-y-6">
        <div>
            <flux:heading size="lg">Edit Note</flux:heading>
            <flux:text class="mt-2">Update existing note</flux:text>
        </div>

        <flux:input label="Title" placeholder="Enter Note Title" wire:model="title" />
         <flux:textarea label="Content" placeholder="Enter Note content" wire:model="content" />

        
        <div class="flex">
            <flux:spacer />

            <flux:button type="submit" variant="primary" wire:click="update">Save changes</flux:button>
        </div>
    </div>
</flux:modal>
</div>