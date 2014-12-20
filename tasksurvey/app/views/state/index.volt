
{{ content() }}

<div align="right">
    {{ link_to("state/new", "Create state") }}
</div>

{{ form("state/search", "method":"post", "autocomplete" : "off") }}

<div align="center">
    <h1>Search state</h1>
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
            <label for="persistent">Persistent</label>
        </td>
        <td align="left">
            {{ text_field("persistent", "type" : "numeric") }}
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
