<center>
<table >
    <thead>
    <tr style="color: #e2e8f0" >
        <th bgcolor="#27B72E"  height="16"  width="16" align="center"  style="color: #e2e8f0 ; font-weight: bold ; font-family: Apple,sans-serif ">Cote</th>
        <th bgcolor="#27B72E"  height="16"  width="16" align="center"  style="color: #e2e8f0 ; font-weight: bold ; font-family: Apple,sans-serif ">Titre</th>
        <th bgcolor="#27B72E"  height="16"  width="16" align="center"  style="color: #e2e8f0 ; font-weight: bold ; font-family: Apple,sans-serif ">Description</th>
        <th bgcolor="#27B72E"  height="16"  width="16" align="center"  style="color: #e2e8f0 ; font-weight: bold ; font-family: Apple,sans-serif ">Parent</th>
        <th bgcolor="#27B72E"  height="16"  width="16" align="center"  style="color: #e2e8f0 ; font-weight: bold ; font-family: Apple,sans-serif ">Sous-classes</th>
        <th bgcolor="#27B72E"  height="16"  width="16" align="center"  style="color: #e2e8f0 ; font-weight: bold ; font-family: Apple,sans-serif ">Pays</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($activities as $activity)
        <tr>
            <td height="20" align="left">{{ $activity->code }}</td>
            <td height="20" align="left">{{ $activity->name }}</td>
            <td height="20" align="left">{{ $activity->description }}</td>
            <td height="20" align="left">{{ $activity->parent ? $activity->parent->name : '' }}</td>
            <td height="20" align="left">{{ $activity->children ? $activity->children->count() : '' }}</td>
            <td height="20" align="left">{{ $activity->countries->name }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</center>
