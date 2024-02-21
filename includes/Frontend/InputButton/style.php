<style>

    @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@100;200;300;400;500;600;700;800;900&display=swap');
    /**
     * forms.css
     *
     * This CSS file provides modern styling for various form elements, including inputs with icons
     * and plain inputs. It uses CSS variables for scalability.
     * Demo:
     * CSS Classes:
     */

    :root {
        /* Color and typography variables for easy customization */
        --font-family: 'Outfit', sans-serif;
        --font-weight: 500;
        --background-color: #f6f8fa;
        --text-color: #23282e;
        --border-color: rgb(208, 215, 222);
        --border-radius: 4px;
        --transition-duration: 0.3s;
        --primary-hover-color: #e5e8eb;
        --focus-outline-color: #0366d6;
        --focus-box-shadow: 0 0 0 3px rgba(3, 102, 214, 0.3);
        --error-border-color: #ff5252;
        --error-bg-color: #ffeeee;
        --alert-border-color: #ffca28;
        --alert-bg-color: #fff9e7;
        --sucess-border-color: #4caf50;
        --sucess-bg-color: #e8f5e9;
        --info-border-color:#0366D6;
        --info-bg-color:#c8ddf5;
    }
    /* Error, Alert, and Info alert styles */
    .error {
        border-color: var(--error-border-color) !important;
        background-color: var(--error-bg-color) !important;
    }

    .alert{
        border-color: var(--alert-border-color) !important;
        background-color: var(--alert-bg-color) !important;
    }

    .success{
        border-color: var(--sucess-border-color) !important;
        background-color: var(--sucess-bg-color); !important;
    }

    .info{
        border-color: var(--info-border-color) !important;
        background-color: var(--info-bg-color)!important;
    }

    .success:hover{
        background-color: var(--sucess-bg-color); !important;

    }



    /* Label styles */
    .label {
        font-family: var(--font-family);
        font-weight: var(--font-weight);
        color: var(--text-color);
    }


    .input:hover,
    .select:hover,
    .checkbox:hover,
    .radio:hover,
    .textarea:hover {
        background-color: var(--primary-hover-color);
    }

    .input:focus,
    .select:focus,
    .checkbox:focus,
    .radio:focus,
    .textarea:focus {
        outline: none;
        border-color: var(--focus-outline-color);
        box-shadow: var(--focus-box-shadow);
    }

    /* Button styles */
    .btn,
    .submit-button,
    .clear-button {
        padding: 8px 16px;
        font-family: var(--font-family);
        font-weight: var(--font-weight);
        background-color: var(--background-color);
        color: var(--text-color);
        border: solid 1px var(--border-color);
        border-radius: var(--border-radius);
        cursor: pointer;
        transition: background-color var(--transition-duration) ease;
    }

    .btn:hover,
    .submit-button:hover,
    .clear-button:hover {
        background-color: var(--primary-hover-color);
    }

    .btn:focus,
    .submit-button:focus,
    .clear-button:focus {
        outline: none;
        border-color: var(--focus-outline-color);
        box-shadow: var(--focus-box-shadow);
    }

    /* Form and fieldset styles */
    form {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        padding: 50px;
    }

    fieldset {
        display: flex;
        align-items: baseline;
        justify-content: center;
        align-content: stretch;
        flex-direction: row;
        gap: 10px;
        border: none;
    }

    legend {
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 10px;
    }

    label {
        font-size: 16px;
        margin-bottom: 8px;
    }

    input,
    select {
        width: 100%;
        padding: 8px;
        margin-bottom: 12px;
        box-sizing: border-box;
    }


    /*===============================================================
    BUTTONS
                            - BASIC
                            - SVG
     ---------------------------------------------------------------*/

    .btn ,.button{
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 5px 20px;
        font-size: 13px;
        font-weight: 600;
        line-height: 1.5;
        color: #24292e;
        background-color: #f6f8fa;
        border: 1px solid #d1d5da;
        border-radius: 35px;
        cursor: pointer;
        transition: background-color 0.3s ease-in-out;
        text-decoration: none;
    }

    .btn:hover {
        background-color: #e1e4e8;
    }






    /* Checkbox and radio styles */
    .form-checkbox,
    .form-radio {
        margin: 0 10px 0 0;
        vertical-align: middle;
    }

    .form-checkbox-group label,
    .form-radio-group label {
        display: flex;
        align-items: center;
        margin: 5px 0;
        min-width: 50px;
    }

    .form-checkbox-group label, .form-radio-group label {
        display: flex;
        align-items: center;
        margin: 5px 0;
        font-family: var(--font-family);
        flex-direction: row;
        justify-content: space-evenly;
        font-size: smaller;
    }





    /*===============================================================
                            INPUT STYLES
                            - BASIC
                            - SVG
                            - BUTTON INPUT
                            - FILE UPLOAD
     ---------------------------------------------------------------*/

    /* Input styles */
    .input,
    .select,
    .checkbox,
    .radio,
    .textarea {
        padding: 8px 16px;
        font-family: var(--font-family);
        font-weight: var(--font-weight);
        background-color: var(--background-color);
        color: var(--text-color);
        border: solid 1px var(--border-color);
        border-radius: var(--border-radius);
        transition: border-color var(--transition-duration) ease;
    }

    input {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 13px;
    }

    /* SVG Icon inside Input */
    .svg-input-container {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
        min-width: 100%;
    }
    .svg-input {
        min-width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }
    .specialized-input-button {
        padding: 10px;
        background-color: var(--border-color);
        color: var(--text-color);
        border: 1px solid var(--border-color);
        border-radius: 0 5px 5px 0;
        cursor: pointer;
    }
    /* Custom style for input wrapper with SVG icon */
    .input-wrapper {
        position: relative;
        min-width: 100%;
    }
    /* Position the SVG icon inside the input */
    .svg-icon {
        position: absolute;
        top: 38%;
        right: 10px;
        width: 16px;
        transform: translateY(-50%);
        fill: #555;
        cursor: pointer;
    }
    input#svg-input{
        padding-right: 36px;
    }
    .specialized-input {
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px 0 0 5px;
    }
    .specialized-input-container {
        display: flex;
        align-items: flex-start;
    }
    input.specialized-input.input.form-input {
        margin-bottom: 0;
    }
    .specialized-input-container {
        display: flex;
        align-items: stretch;
    }
    /*File Upload*/
    .drag-drop-container {
        width: 300px;
        height: 200px;
        padding: 20px;
        border-radius: 10px;
        border: 2px dashed var(--border-color);
        display: flex;
        background-color: var(--light-color);
        justify-content: center;
        align-items: center;
        text-align: center;
        margin: 0 auto;
        color: var(--text-color);
        flex-direction: column;
    }
    .drag-drop-container svg{
        fill: var(--light-color);
        width: 30px;
    }
    .drag-drop-container.dragover {
        border-style: solid;
    }

    label{
        display: none;
    }


    .input-button-demo{
        display: flex;
        max-width: 400px;
        padding: 20px;
        margin: 0 auto;
    }
</style>