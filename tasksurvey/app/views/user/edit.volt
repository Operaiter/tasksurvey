{{ content() }}
{{ form("user/save", "method":"post") }}

<table width="100%">
    <tr>
        <td align="left">{{ link_to("user", "Go Back") }}</td>
        <td align="right">{{ submit_button("Save") }}</td>
    </tr>
</table>

<div align="center">
    <h1>Edit user</h1>
</div>

<table>
    <tr>
        <td align="right">
            <label for="unit_id">Unit</label>
        </td>
        <td align="left">
            {{ text_field("unit_id", "type" : "numeric") }}
        </td>
    </tr>
    <tr>
        <td align="right">
            <label for="rank">Rank</label>
        </td>
        <td align="left">
            {{ text_field("rank", "type" : "numeric") }}
        </td>
    </tr>
    <tr>
        <td align="right">
            <label for="prename">Prename</label>
        </td>
        <td align="left">
            {{ text_field("prename", "size" : 30) }}
        </td>
    </tr>
    <tr>
        <td align="right">
            <label for="lastname">Lastname</label>
        </td>
        <td align="left">
            {{ text_field("lastname", "size" : 30) }}
        </td>
    </tr>

    <tr>
        <td>{{ hidden_field("id") }}</td>
        <td>{{ submit_button("Save") }}</td>
    </tr>
</table>

</form>
