<table>
    <thead>
    <tr>
        <th>Cote</th>
        <th>Titre</th>
        <th>Description</th>
        <th>Parent</th>
        <th>Sous-classes</th>
        <th>Pays</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($activities as $activity)
        <tr>
            <td>{{ $activity->code }}</td>
            <td>{{ $activity->name }}</td>
            <td>{{ $activity->description }}</td>
            <td>{{ $activity->parent ? $activity->parent->name : '' }}</td>
            <td>{{ $activity->children ? $activity->children->count() : '' }}</td>
            <td>{{ $activity->countries->name }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
