<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <title>Todo</title>
</head>
<body>
    <div class="container mt-5">
        <form method="POST" action="{{ route('todos.store') }}">
            @csrf
            <div class="input-group mb-3">
                <input type="text" class="form-control" name="name" placeholder="Nova Tarefa" required>
                <button type="submit" class="btn btn-primary">Adicionar Tarefa</button>
            </div>
        </form>

        <h4>Tarefas Pendentes</h4>
        <ul class="list-group mb-4">
            @php $hasPendingTasks = false; @endphp
            @foreach($todos as $todo)
                @if (!$todo->completed) 
                    @php $hasPendingTasks = true; @endphp
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <form method="POST" action="{{ route('todos.complete', $todo->id) }}" style="display:inline;">
                            @csrf
                            <input type="checkbox" name="completed" onchange="this.form.submit()" {{ $todo->completed ? 'checked' : '' }}>
                            {{ $todo->name }}
                        </form>
                        <form method="POST" action="{{ route('todos.destroy', $todo->id) }}" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Deletar</button>
                        </form>
                    </li>
                @endif
            @endforeach
            @if (!$hasPendingTasks)
                <li class="list-group-item">Nenhuma tarefa encontrada.</li>
            @endif
        </ul>

        <h4>Tarefas Concluídas</h4>
        <ul class="list-group mb-4">
            @php $completedTodo = false; @endphp
            @foreach($todos as $todo)
                @if ($todo->completed) 
                    @php $completedTodo = true; @endphp
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <form method="POST" action="{{ route('todos.complete', $todo->id) }}" style="display:inline;">
                            @csrf
                            <input type="checkbox" name="completed" onchange="this.form.submit()" {{ $todo->completed ? 'checked' : '' }}>
                            {{ $todo->name }}
                        </form>
                        <form method="POST" action="{{ route('todos.destroy', $todo->id) }}" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Deletar</button>
                        </form>
                    </li>
                @endif
            @endforeach
            @if (!$completedTodo)
                <li class="list-group-item">Nenhuma tarefa concluida.</li>
            @endif
        </ul>
    </div>
</body>
</html>
