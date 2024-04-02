@include('components.head')

<body>
    <div class="container">
        <h1>Edit Task</h1>
        <form action="{{ route('tasks.update', $task->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" value="{{ $task->title }}" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" rows="3">{{ $task->description }}</textarea>
            </div>
            <div class="form-group">
                <label for="priority">Priority</label>
                <select id="priority" name="priority" required>
                    <option value="low" @if($task->priority == 'low') selected @endif>Low</option>
                    <option value="medium" @if($task->priority == 'medium') selected @endif>Medium</option>
                    <option value="high" @if($task->priority == 'high') selected @endif>High</option>
                </select>
            </div>
            <div class="form-group">
                <label for="due_date">Due Date</label>
                <input type="date" id="due_date" name="due_date" value="{{ $task->due_date }}">
            </div>
            <button type="submit">Update Task</button>
        </form>
    </div>
</body>

</html>
