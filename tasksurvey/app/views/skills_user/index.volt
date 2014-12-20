
{{ content() }}

<div align="right">
    {{ link_to("skills_user/new", "Create skills_user") }}
</div>

{{ form("skills_user/search", "method":"post", "autocomplete" : "off") }}

<div align="center">
    <h1>Search skills_user</h1>
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
            <label for="skills_id">Skills</label>
        </td>
        <td align="left">
            {{ text_field("skills_id", "type" : "numeric") }}
        </td>
    </tr>

    <tr>
        <td></td>
        <td>{{ submit_button("Search") }}</td>
    </tr>
</table>

</form>
