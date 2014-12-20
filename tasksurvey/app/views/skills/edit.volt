{{ content() }}
{{ form("skills/save", "method":"post") }}

<table width="100%">
    <tr>
        <td align="left">{{ link_to("skills", "Go Back") }}</td>
        <td align="right">{{ submit_button("Save") }}</td>
    </tr>
</table>

<div align="center">
    <h1>Edit skills</h1>
</div>

<table>
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
        <td>{{ hidden_field("id") }}</td>
        <td>{{ submit_button("Save") }}</td>
    </tr>
</table>

</form>
