
{{ content() }}

<div align="right">
    {{ link_to("state_user/new", "Create state_user") }}
</div>

{{ form("state_user/search", "method":"post", "autocomplete" : "off") }}

<div align="center">
    <h1>Search state_user</h1>
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
            <label for="state_id">State</label>
        </td>
        <td align="left">
            {{ text_field("state_id", "type" : "numeric") }}
        </td>
    </tr>

    <tr>
        <td></td>
        <td>{{ submit_button("Search") }}</td>
    </tr>
</table>

</form>
