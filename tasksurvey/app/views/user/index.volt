
{{ content() }}

<div align="right">
    {{ link_to("user/new", "Create user") }}
</div>

{{ form("user/search", "method":"post", "autocomplete" : "off") }}

<div align="center">
    <h1>Search user</h1>
</div>

<table>
    <tr>
        <td align="right">
            <label for="user_id">User</label>
        </td>
        <td align="left">
            {{ text_field("user_id", "type" : "numeric") }}
        </td>
    </tr>
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
        <td></td>
        <td>{{ submit_button("Search") }}</td>
    </tr>
</table>

</form>
