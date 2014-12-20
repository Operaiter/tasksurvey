
{{ content() }}

<div align="right">
    {{ link_to("mission_user_state/new", "Create mission_user_state") }}
</div>

{{ form("mission_user_state/search", "method":"post", "autocomplete" : "off") }}

<div align="center">
    <h1>Search mission_user_state</h1>
</div>

<table>
    <tr>
        <td align="right">
            <label for="state_id">State</label>
        </td>
        <td align="left">
            {{ text_field("state_id", "type" : "numeric") }}
        </td>
    </tr>
    <tr>
        <td align="right">
            <label for="mission_id">Mission</label>
        </td>
        <td align="left">
            {{ text_field("mission_id", "type" : "numeric") }}
        </td>
    </tr>
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
            <label for="state">State</label>
        </td>
        <td align="left">
            {{ text_field("state", "type" : "numeric") }}
        </td>
    </tr>

    <tr>
        <td></td>
        <td>{{ submit_button("Search") }}</td>
    </tr>
</table>

</form>
