
{{ content() }}

<div align="right">
    {{ link_to("partner/new", "Create partner") }}
</div>

{{ form("partner/search", "method":"post", "autocomplete" : "off") }}

<div align="center">
    <h1>Search partner</h1>
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
        <td></td>
        <td>{{ submit_button("Search") }}</td>
    </tr>
</table>

</form>
