
{{ content() }}

<div align="right">
    {{ link_to("mission/new", "Create mission") }}
</div>

{{ form("mission/search", "method":"post", "autocomplete" : "off") }}

<div align="center">
    <h1>Search mission</h1>
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
            <label for="time">Time</label>
        </td>
        <td align="left">
            {{ text_field("time", "type" : "numeric") }}
        </td>
    </tr>
    <tr>
        <td align="right">
            <label for="active">Active</label>
        </td>
        <td align="left">
            {{ text_field("active", "type" : "numeric") }}
        </td>
    </tr>
    <tr>
        <td align="right">
            <label for="time_change">Time Of Change</label>
        </td>
        <td align="left">
            {{ text_field("time_change", "type" : "numeric") }}
        </td>
    </tr>

    <tr>
        <td></td>
        <td>{{ submit_button("Search") }}</td>
    </tr>
</table>

</form>
