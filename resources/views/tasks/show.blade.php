@include('components.head')

<body>
    <div class="container">
        <br>
        <h1>Completed Tasks</h1>
        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Completion Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($completedTasks as $task)
                <tr>
                    <td>{{ $task->title }}</td>
                    <td>{{ $task->description }}</td>
                    <td>{{ $task->completed_at }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
