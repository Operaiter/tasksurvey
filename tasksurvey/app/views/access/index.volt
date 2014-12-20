
{{ content() }}

<div align="right">
    {{ link_to("access/new", "Create access") }}
</div>

{{ form("access/search", "method":"post", "autocomplete" : "off") }}

<div align="center">
    <h1>Search access</h1>
</div>

<table>
    <tr>
        <td align="right">
            <label for="access_id">Access</label>
        </td>
        <td align="left">
            {{ text_field("access_id", "type" : "numeric") }}
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
