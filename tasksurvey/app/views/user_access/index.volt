
{{ content() }}

<div align="right">
    {{ link_to("user_access/new", "Create user_access") }}
</div>

{{ form("user_access/search", "method":"post", "autocomplete" : "off") }}

<div align="center">
    <h1>Search user_access</h1>
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
            <label for="access_id">Access</label>
        </td>
        <td align="left">
            {{ text_field("access_id", "type" : "numeric") }}
        </td>
    </tr>

    <tr>
        <td></td>
        <td>{{ submit_button("Search") }}</td>
    </tr>
</table>

</form>
