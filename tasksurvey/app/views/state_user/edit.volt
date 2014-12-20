{{ content() }}
{{ form("state_user/save", "method":"post") }}

<table width="100%">
    <tr>
        <td align="left">{{ link_to("state_user", "Go Back") }}</td>
        <td align="right">{{ submit_button("Save") }}</td>
    </tr>
</table>

<div align="center">
    <h1>Edit state_user</h1>
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
        <td>{{ hidden_field("id") }}</td>
        <td>{{ submit_button("Save") }}</td>
    </tr>
</table>

</form>
