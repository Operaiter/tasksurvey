
{{ content() }}

<div align="right">
    {{ link_to("skills/new", "Create skills") }}
</div>

{{ form("skills/search", "method":"post", "autocomplete" : "off") }}

<div align="center">
    <h1>Search skills</h1>
</div>

<table>
    <tr>
        <td align="right">
            <label for="skills_id">Skills</label>
        </td>
        <td align="left">
            {{ text_field("skills_id", "type" : "numeric") }}
        </td>
    </tr>
    <tr>
        <td align="right">
            <label for="partner_id">Partner</label>
        </td>
        <td align="left">
            {{ text_field("partner_id", "type" : "numeric") }}
        </td>
    </tr>
    <tr>
        <td align="right">
            <label for="name">Name</label>
        </td>
        <td align="left">
            {{ text_field("name", "size" : 30) }}
        </td>
    </tr>
    <tr>
        <td align="right">
            <label for="name_short">Name Of Short</label>
        </td>
        <td align="left">
            {{ text_field("name_short", "size" : 30) }}
        </td>
    </tr>
    <tr>
        <td align="right">
            <label for="description">Description</label>
        </td>
        <td align="left">
                {{ text_field("description", "type" : "date") }}
        </td>
    </tr>

    <tr>
        <td></td>
        <td>{{ submit_button("Search") }}</td>
    </tr>
</table>

</form>
