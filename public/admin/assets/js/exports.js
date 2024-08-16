import {
    DataTable,
    exportJSON,
    exportCSV,
    exportTXT,
    exportSQL
} from "./module.js"

const exportCustomCSV = function (dataTable, userOptions = {}) {
    // A modified CSV export that includes a row of minuses at the start and end.
    const clonedUserOptions = {
        ...userOptions
    }
    clonedUserOptions.download = false
    const csv = exportCSV(dataTable, clonedUserOptions)
    // If CSV didn't work, exit.
    if (!csv) {
        return false
    }
    const defaults = {
        download: true,
        lineDelimiter: "\n",
        columnDelimiter: ";"
    }
    const options = {
        ...defaults,
        ...clonedUserOptions
    }
    const separatorRow = Array(dataTable.data.headings.filter((_heading, index) => !dataTable.columns.settings[index]?.hidden).length)
        .fill("-")
        .join(options.columnDelimiter)
    const str = `${separatorRow}${options.lineDelimiter}${csv}${options.lineDelimiter}${separatorRow}`
    if (userOptions.download) {
        // Create a link to trigger the download
        const link = document.createElement("a")
        link.href = encodeURI(`data:text/csv;charset=utf-8,${str}`)
        link.download = `${options.filename || "datatable_export"}.txt`
        // Append the link
        document.body.appendChild(link)
        // Trigger the download
        link.click()
        // Remove the link
        document.body.removeChild(link)
    }
    return str
}
const table = new DataTable("#demo-table")
document.getElementById("export-csv").addEventListener("click", () => {
    exportCSV(table, {
        download: true,
        lineDelimiter: "\n",
        columnDelimiter: ";"
    })
})
document.getElementById("export-sql").addEventListener("click", () => {
    exportSQL(table, {
        download: true,
        tableName: "export_table"
    })
})
document.getElementById("export-txt").addEventListener("click", () => {
    exportTXT(table, {
        download: true
    })
})
document.getElementById("export-json").addEventListener("click", () => {
    exportJSON(table, {
        download: true,
        space: 3
    })
})
document.getElementById("export-custom").addEventListener("click", () => {
    exportCustomCSV(table, {
        download: true
    })
})