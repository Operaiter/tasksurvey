
{{ content() }}

<div align="right">
    {{ link_to("rank/new", "Create rank") }}
</div>

{{ form("rank/search", "method":"post", "autocomplete" : "off") }}

<div align="center">
    <h1>Search rank</h1>
</div>

<table>
    <tr>
        <td align="right">
            <label for="rank_id">Rank</label>
        </td>
        <td align="left">
            {{ text_field("rank_id", "type" : "numeric") }}
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
