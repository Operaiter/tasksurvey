{{ content() }}
{{ form("mission_user_state/save", "method":"post") }}

<table width="100%">
    <tr>
        <td align="left">{{ link_to("mission_user_state", "Go Back") }}</td>
        <td align="right">{{ submit_button("Save") }}</td>
    </tr>
</table>

<div align="center">
    <h1>Edit mission_user_state</h1>
</div>

<table>
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
        <td>{{ hidden_field("id") }}</td>
        <td>{{ submit_button("Save") }}</td>
    </tr>
</table>

</form>
