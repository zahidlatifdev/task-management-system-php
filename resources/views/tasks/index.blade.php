@include('components.head')

<body>
    <div class="container">
        <h1>Task Management System</h1>

        <h2>Task List</h2>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('tasks.create') }}" class="btn">Create Task</a>
        <a href="{{ route('tasks.show') }}" class="btn">Show Completed Tasks</a>

        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Priority</th>
                    <th>Due Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tasks as $task)
                    <tr>
                        <td>{{ $task->title }}</td>
                        <td>{{ $task->description }}</td>
                        <td>{{ $task->priority }}</td>
                        <td>{{ $task->due_date }}</td>
                        <td class="actions">
                            <div class="button-group">
                                <a href="{{ route('tasks.edit', $task->id) }}" class="btn">Edit</a>
                                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn"
                                        onclick="return confirm('Are you sure you want to delete this task?')">Delete</button>
                                </form>
                                @if (!$task->completed)
                                    <form action="{{ route('tasks.complete', $task->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn">Complete</button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
