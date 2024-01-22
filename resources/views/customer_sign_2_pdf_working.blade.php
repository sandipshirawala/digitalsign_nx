<!DOCTYPE html>
<!--
Copyright 2012 Mozilla Foundation

Licensed under the Apache License, Version 2.0 (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at

    http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an "AS IS" BASIS,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and
limitations under the License.

Adobe CMap resources are covered by their own copyright but the same license:

    Copyright 1990-2015 Adobe Systems Incorporated.

See https://github.com/adobe-type-tools/cmap-resources
-->
<html dir="ltr" mozdisallowselectionprint>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="google" content="notranslate">
    <title>PDF.js viewer</title>

<!-- This snippet is used in production (included from viewer.html) -->
<link rel="resource" type="application/l10n" href="locale/locale.properties">
<script src="pdf_assets/build/pdf.js"></script>
<!--<script src="https://unpkg.com/pdf-lib@1.11.0"></script>
	<script src="https://unpkg.com/pdf-lib@1.14.0"></script>
   <script src="https://unpkg.com/downloadjs@1.4.7"></script>-->
   <script src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<!-- Bootstrap JS and Popper.js -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<!--<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>-->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="pdf_assets/viewer.css">
    <script type="text/javascript">
      //let new_file_name="compressed.tracemonkey-pldi-09.pdf";
      //let new_file_name="registration_form.pdf";
      //let new_file_name = "pdf_files/20251_Netbanking Fillable.pdf";
      let new_file_name = "pdf_files/<?php echo $file_name; ?>";
      //alert(new_file_name);
    </script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/1.3.8/FileSaver.min.js"></script>
    
  <script src="pdf_assets/viewer.js"></script>
  <style>
      #outerContainer {
      width: 800px; 
      height: 600px;
      margin: auto;
      background-color: #f0f0f0; 
      outline: none; 
	  position: relative;
    }
    .visible-image {
      display: block;
    }

    #nextButton {
     /* position: absolute;*/
     /*
       background-color: grey;
	   color: white;
	   padding: 10px 20px;
	    border-radius: 5px;	
		cursor: pointer;
		font-weight: bold;
		margin:10px;	
		*/
    }
	#nextButton:hover {
	    /*
  background-color: #45a049; 
   */
}

/*
#nextButton::after {
  content: '\2192'; 
  margin-left: 5px; 
  font-weight: bold;
}
*/

#finishButton::before {
  content: '\2713'; 
  margin-right: 5px; 
  font-weight: bold;
}

    #startFinishButtons {
      text-align: left;
      margin: 10px;
    }

    #startButton, #finishButton {
        /*
      background-color: #4CAF50;
      color: white;
      padding: 10px 30px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      margin-left: 20px;
      */
    }
	#finishButton {
		/* background-color: grey; */
	}
	         .modal-open {
                    overflow: hidden;
                  }

                  .modal-open .modal {
                    overflow-x: hidden;
                    overflow-y: auto;
                  }

                  .modal {
                    position: fixed;
                    top: 0;
                    left: 0;
                    z-index: 1050;
                    display: none;
                    width: 100%;
                    height: 100%;
                    overflow: hidden;
                    outline: 0;
                  }

                  .modal-dialog {
                    position: relative;
                    width: auto;
                    margin: 0.5rem;
                    pointer-events: none;
                  }

                  .modal.fade .modal-dialog {
                    transition: -webkit-transform 0.3s ease-out;
                    transition: transform 0.3s ease-out;
                    transition: transform 0.3s ease-out, -webkit-transform 0.3s ease-out;
                    -webkit-transform: translate(0, -50px);
                    transform: translate(0, -50px);
                  }

                  @media (prefers-reduced-motion: reduce) {
                    .modal.fade .modal-dialog {
                      transition: none;
                    }
                  }

                  .modal.show .modal-dialog {
                    -webkit-transform: none;
                    transform: none;
                  }

                  .modal.modal-static .modal-dialog {
                    -webkit-transform: scale(1.02);
                    transform: scale(1.02);
                  }

                  .modal-dialog-scrollable {
                    display: -ms-flexbox;
                    display: flex;
                    max-height: calc(100% - 1rem);
                  }

                  .modal-dialog-scrollable .modal-content {
                    max-height: calc(100vh - 1rem);
                    overflow: hidden;
                  }

                  .modal-dialog-scrollable .modal-header,
                  .modal-dialog-scrollable .modal-footer {
                    -ms-flex-negative: 0;
                    flex-shrink: 0;
                  }

                  .modal-dialog-scrollable .modal-body {
                    overflow-y: auto;
                  }

                  .modal-dialog-centered {
                    display: -ms-flexbox;
                    display: flex;
                    -ms-flex-align: center;
                    align-items: center;
                    min-height: calc(100% - 1rem);
                  }

                  .modal-dialog-centered::before {
                    display: block;
                    height: calc(100vh - 1rem);
                    height: -webkit-min-content;
                    height: -moz-min-content;
                    height: min-content;
                    content: "";
                  }

                  .modal-dialog-centered.modal-dialog-scrollable {
                    -ms-flex-direction: column;
                    flex-direction: column;
                    -ms-flex-pack: center;
                    justify-content: center;
                    height: 100%;
                  }

                  .modal-dialog-centered.modal-dialog-scrollable .modal-content {
                    max-height: none;
                  }

                  .modal-dialog-centered.modal-dialog-scrollable::before {
                    content: none;
                  }

                  .modal-content {
                    position: relative;
                    display: -ms-flexbox;
                    display: flex;
                    -ms-flex-direction: column;
                    flex-direction: column;
                    width: 100%;
                    pointer-events: auto;
                    background-color: #fff;
                    background-clip: padding-box;
                    border: 1px solid rgba(0, 0, 0, 0.2);
                    border-radius: 0.3rem;
                    outline: 0;
                  }

                  .modal-backdrop {
                    position: fixed;
                    top: 0;
                    left: 0;
                    z-index: 1040;
                    width: 100vw;
                    height: 100vh;
                    background-color: #000;
                  }

                  .modal-backdrop.fade {
                    opacity: 0;
                  }

                  .modal-backdrop.show {
                    opacity: 0.5;
                  }

                  .modal-header {
                    display: -ms-flexbox;
                    display: flex;
                    -ms-flex-align: start;
                    align-items: flex-start;
                    -ms-flex-pack: justify;
                    justify-content: space-between;
                    padding: 1rem 1rem;
                    border-bottom: 1px solid #dee2e6;
                    border-top-left-radius: calc(0.3rem - 1px);
                    border-top-right-radius: calc(0.3rem - 1px);
                  }

                  .modal-header .close {
                    padding: 1rem 1rem;
                    margin: -1rem -1rem -1rem auto;
                  }

                  .modal-title {
                    margin-bottom: 0;
                    line-height: 1.5;
                  }

                  .modal-body {
                    position: relative;
                    -ms-flex: 1 1 auto;
                    flex: 1 1 auto;
                    padding: 1rem;
                  }

                  .modal-footer {
                    display: -ms-flexbox;
                    display: flex;
                    -ms-flex-wrap: wrap;
                    flex-wrap: wrap;
                    -ms-flex-align: center;
                    align-items: center;
                    -ms-flex-pack: end;
                    justify-content: flex-end;
                    padding: 0.75rem;
                    border-top: 1px solid #dee2e6;
                    border-bottom-right-radius: calc(0.3rem - 1px);
                    border-bottom-left-radius: calc(0.3rem - 1px);
                  }

                  .modal-footer > * {
                    margin: 0.25rem;
                  }

                  .modal-scrollbar-measure {
                    position: absolute;
                    top: -9999px;
                    width: 50px;
                    height: 50px;
                    overflow: scroll;
                  }

                  @media (min-width: 576px) {
                    .modal-dialog {
                      max-width: 500px;
                      margin: 1.75rem auto;
                    }
                    .modal-dialog-scrollable {
                      max-height: calc(100% - 3.5rem);
                    }
                    .modal-dialog-scrollable .modal-content {
                      max-height: calc(100vh - 3.5rem);
                    }
                    .modal-dialog-centered {
                      min-height: calc(100% - 3.5rem);
                    }
                    .modal-dialog-centered::before {
                      height: calc(100vh - 3.5rem);
                      height: -webkit-min-content;
                      height: -moz-min-content;
                      height: min-content;
                    }
                    .modal-sm {
                      max-width: 300px;
                    }
                    @media (min-width: 992px) {
                      .modal-lg,
                      .modal-xl {
                        max-width: 800px;
                      }
                    }

                    @media (min-width: 1200px) {
                      .modal-xl {
                        max-width: 1140px;
                      }
                    }
                  }


  </style>
  </head>

  <body tabindex="1">
    <nav id="startFinishButtons">
    <!--<button type="button" id="startButton" onclick="startTimer()">Start</button>
    <button type="button" id="finishButton" onclick="finishTimer()">Finish</button>
    <button type="button" id="nextButton" disabled>Next</button>-->
  </nav>
  
    <div id="outerContainer">

      <div id="sidebarContainer">
        <div id="toolbarSidebar">
          <div id="toolbarSidebarLeft">
            <div id="sidebarViewButtons" class="splitToolbarButton toggled" role="radiogroup">
              <button id="viewThumbnail" class="toolbarButton toggled" title="Show Thumbnails" tabindex="2" data-l10n-id="thumbs" role="radio" aria-checked="true" aria-controls="thumbnailView">
                 <span data-l10n-id="thumbs_label">Thumbnails</span>
              </button>
              <button id="viewOutline" class="toolbarButton" title="Show Document Outline (double-click to expand/collapse all items)" tabindex="3" data-l10n-id="document_outline" role="radio" aria-checked="false" aria-controls="outlineView">
                 <span data-l10n-id="document_outline_label">Document Outline</span>
              </button>
              <button id="viewAttachments" class="toolbarButton" title="Show Attachments" tabindex="4" data-l10n-id="attachments" role="radio" aria-checked="false" aria-controls="attachmentsView">
                 <span data-l10n-id="attachments_label">Attachments</span>
              </button>
              <button id="viewLayers" class="toolbarButton" title="Show Layers (double-click to reset all layers to the default state)" tabindex="5" data-l10n-id="layers" role="radio" aria-checked="false" aria-controls="layersView">
                 <span data-l10n-id="layers_label">Layers</span>
              </button>
            </div>
          </div>

          <div id="toolbarSidebarRight">
            <div id="outlineOptionsContainer" class="hidden">
              <div class="verticalToolbarSeparator"></div>

              <button id="currentOutlineItem" class="toolbarButton" disabled="disabled" title="Find Current Outline Item" tabindex="6" data-l10n-id="current_outline_item">
                <span data-l10n-id="current_outline_item_label">Current Outline Item</span>
              </button>
            </div>
          </div>
        </div>
        <div id="sidebarContent">
          <div id="thumbnailView">
          </div>
          <div id="outlineView" class="hidden">
          </div>
          <div id="attachmentsView" class="hidden">
          </div>
          <div id="layersView" class="hidden">
          </div>
        </div>
        <div id="sidebarResizer"></div>
      </div>  <!-- sidebarContainer -->

      <div id="mainContainer">
        <div class="findbar hidden doorHanger" id="findbar">
          <div id="findbarInputContainer">
            <input id="findInput" class="toolbarField" title="Find" placeholder="Find in document…" tabindex="91" data-l10n-id="find_input" aria-invalid="false">
            <div class="splitToolbarButton">
              <button id="findPrevious" class="toolbarButton" title="Find the previous occurrence of the phrase" tabindex="92" data-l10n-id="find_previous">
                <span data-l10n-id="find_previous_label">Previous</span>
              </button>
              <div class="splitToolbarButtonSeparator"></div>
              <button id="findNext" class="toolbarButton" title="Find the next occurrence of the phrase" tabindex="93" data-l10n-id="find_next">
                <span data-l10n-id="find_next_label">Next</span>
              </button>
            </div>
          </div>

          <div id="findbarOptionsOneContainer">
            <input type="checkbox" id="findHighlightAll" class="toolbarField" tabindex="94">
            <label for="findHighlightAll" class="toolbarLabel" data-l10n-id="find_highlight">Highlight All</label>
            <input type="checkbox" id="findMatchCase" class="toolbarField" tabindex="95">
            <label for="findMatchCase" class="toolbarLabel" data-l10n-id="find_match_case_label">Match Case</label>
          </div>
          <div id="findbarOptionsTwoContainer">
            <input type="checkbox" id="findMatchDiacritics" class="toolbarField" tabindex="96">
            <label for="findMatchDiacritics" class="toolbarLabel" data-l10n-id="find_match_diacritics_label">Match Diacritics</label>
            <input type="checkbox" id="findEntireWord" class="toolbarField" tabindex="97">
            <label for="findEntireWord" class="toolbarLabel" data-l10n-id="find_entire_word_label">Whole Words</label>
          </div>

          <div id="findbarMessageContainer" aria-live="polite">
            <span id="findResultsCount" class="toolbarLabel"></span>
            <span id="findMsg" class="toolbarLabel"></span>
          </div>
        </div>  <!-- findbar -->

        <div class="editorParamsToolbar hidden doorHangerRight" id="editorFreeTextParamsToolbar">
          <div class="editorParamsToolbarContainer">
            <div class="editorParamsSetter">
              <label for="editorFreeTextColor" class="editorParamsLabel" data-l10n-id="editor_free_text_color">Color</label>
              <input type="color" id="editorFreeTextColor" class="editorParamsColor" tabindex="100">
            </div>
            <div class="editorParamsSetter">
              <label for="editorFreeTextFontSize" class="editorParamsLabel" data-l10n-id="editor_free_text_size">Size</label>
              <input type="range" id="editorFreeTextFontSize" class="editorParamsSlider" value="10" min="5" max="100" step="1" tabindex="101">
            </div>
          </div>
        </div>

        <div class="editorParamsToolbar hidden doorHangerRight" id="editorInkParamsToolbar">
          <div class="editorParamsToolbarContainer">
            <div class="editorParamsSetter">
              <label for="editorInkColor" class="editorParamsLabel" data-l10n-id="editor_ink_color">Color</label>
              <input type="color" id="editorInkColor" class="editorParamsColor" tabindex="102">
            </div>
            <div class="editorParamsSetter">
              <label for="editorInkThickness" class="editorParamsLabel" data-l10n-id="editor_ink_thickness">Thickness</label>
              <input type="range" id="editorInkThickness" class="editorParamsSlider" value="1" min="1" max="20" step="1" tabindex="103">
            </div>
            <div class="editorParamsSetter">
              <label for="editorInkOpacity" class="editorParamsLabel" data-l10n-id="editor_ink_opacity">Opacity</label>
              <input type="range" id="editorInkOpacity" class="editorParamsSlider" value="100" min="1" max="100" step="1" tabindex="104">
            </div>
          </div>
        </div>

        <div class="editorParamsToolbar hidden doorHangerRight" id="editorStampParamsToolbar">
          <div class="editorParamsToolbarContainer">
            <button id="editorStampAddImage" class="secondaryToolbarButton" title="Add image" tabindex="105" data-l10n-id="editor_stamp_add_image">
              <span data-l10n-id="editor_stamp_add_image_label">Add image</span>
            </button>
          </div>
        </div>

        <div id="secondaryToolbar" class="secondaryToolbar hidden doorHangerRight">
          <div id="secondaryToolbarButtonContainer">
            <button id="secondaryOpenFile" class="secondaryToolbarButton visibleLargeView" title="Open File" tabindex="51" data-l10n-id="open_file">
              <span data-l10n-id="open_file_label">Open</span>
            </button>

            <button id="secondaryPrint" class="secondaryToolbarButton visibleMediumView" title="Print" tabindex="52" data-l10n-id="print">
              <span data-l10n-id="print_label">Print</span>
            </button>

            <button id="secondaryDownload" class="secondaryToolbarButton visibleMediumView" title="Save" tabindex="53" data-l10n-id="save">
              <span data-l10n-id="save_label">Save</span>
            </button>

            <div class="horizontalToolbarSeparator visibleLargeView"></div>

            <button id="presentationMode" class="secondaryToolbarButton" title="Switch to Presentation Mode" tabindex="54" data-l10n-id="presentation_mode">
              <span data-l10n-id="presentation_mode_label">Presentation Mode</span>
            </button>

            <a href="#" id="viewBookmark" class="secondaryToolbarButton" title="Current Page (View URL from Current Page)" tabindex="55" data-l10n-id="bookmark1">
              <span data-l10n-id="bookmark1_label">Current Page</span>
            </a>

            <div id="viewBookmarkSeparator" class="horizontalToolbarSeparator"></div>

            <button id="firstPage" class="secondaryToolbarButton" title="Go to First Page" tabindex="56" data-l10n-id="first_page">
              <span data-l10n-id="first_page_label">Go to First Page</span>
            </button>
            <button id="lastPage" class="secondaryToolbarButton" title="Go to Last Page" tabindex="57" data-l10n-id="last_page">
              <span data-l10n-id="last_page_label">Go to Last Page</span>
            </button>

            <div class="horizontalToolbarSeparator"></div>

            <button id="pageRotateCw" class="secondaryToolbarButton" title="Rotate Clockwise" tabindex="58" data-l10n-id="page_rotate_cw">
              <span data-l10n-id="page_rotate_cw_label">Rotate Clockwise</span>
            </button>
            <button id="pageRotateCcw" class="secondaryToolbarButton" title="Rotate Counterclockwise" tabindex="59" data-l10n-id="page_rotate_ccw">
              <span data-l10n-id="page_rotate_ccw_label">Rotate Counterclockwise</span>
            </button>

            <div class="horizontalToolbarSeparator"></div>

            <div id="cursorToolButtons" role="radiogroup">
              <button id="cursorSelectTool" class="secondaryToolbarButton toggled" title="Enable Text Selection Tool" tabindex="60" data-l10n-id="cursor_text_select_tool" role="radio" aria-checked="true">
                <span data-l10n-id="cursor_text_select_tool_label">Text Selection Tool</span>
              </button>
              <button id="cursorHandTool" class="secondaryToolbarButton" title="Enable Hand Tool" tabindex="61" data-l10n-id="cursor_hand_tool" role="radio" aria-checked="false">
                <span data-l10n-id="cursor_hand_tool_label">Hand Tool</span>
              </button>
            </div>

            <div class="horizontalToolbarSeparator"></div>

            <div id="scrollModeButtons" role="radiogroup">
              <button id="scrollPage" class="secondaryToolbarButton" title="Use Page Scrolling" tabindex="62" data-l10n-id="scroll_page" role="radio" aria-checked="false">
                <span data-l10n-id="scroll_page_label">Page Scrolling</span>
              </button>
              <button id="scrollVertical" class="secondaryToolbarButton toggled" title="Use Vertical Scrolling" tabindex="63" data-l10n-id="scroll_vertical" role="radio" aria-checked="true">
                <span data-l10n-id="scroll_vertical_label" >Vertical Scrolling</span>
              </button>
              <button id="scrollHorizontal" class="secondaryToolbarButton" title="Use Horizontal Scrolling" tabindex="64" data-l10n-id="scroll_horizontal" role="radio" aria-checked="false">
                <span data-l10n-id="scroll_horizontal_label">Horizontal Scrolling</span>
              </button>
              <button id="scrollWrapped" class="secondaryToolbarButton" title="Use Wrapped Scrolling" tabindex="65" data-l10n-id="scroll_wrapped" role="radio" aria-checked="false">
                <span data-l10n-id="scroll_wrapped_label">Wrapped Scrolling</span>
              </button>
            </div>

            <div class="horizontalToolbarSeparator"></div>

            <div id="spreadModeButtons" role="radiogroup">
              <button id="spreadNone" class="secondaryToolbarButton toggled" title="Do not join page spreads" tabindex="66" data-l10n-id="spread_none" role="radio" aria-checked="true">
                <span data-l10n-id="spread_none_label">No Spreads</span>
              </button>
              <button id="spreadOdd" class="secondaryToolbarButton" title="Join page spreads starting with odd-numbered pages" tabindex="67" data-l10n-id="spread_odd" role="radio" aria-checked="false">
                <span data-l10n-id="spread_odd_label">Odd Spreads</span>
              </button>
              <button id="spreadEven" class="secondaryToolbarButton" title="Join page spreads starting with even-numbered pages" tabindex="68" data-l10n-id="spread_even" role="radio" aria-checked="false">
                <span data-l10n-id="spread_even_label">Even Spreads</span>
              </button>
            </div>

            <div class="horizontalToolbarSeparator"></div>

            <button id="documentProperties" class="secondaryToolbarButton" title="Document Properties…" tabindex="69" data-l10n-id="document_properties" aria-controls="documentPropertiesDialog">
              <span data-l10n-id="document_properties_label">Document Properties…</span>
            </button>
          </div>
        </div>  <!-- secondaryToolbar -->

        <div class="toolbar">
          <div id="toolbarContainer">
            <div id="toolbarViewer">
              <div id="toolbarViewerLeft">
                <button id="sidebarToggle" class="toolbarButton" title="Toggle Sidebar" tabindex="11" data-l10n-id="toggle_sidebar" aria-expanded="false" aria-controls="sidebarContainer">
                  <span data-l10n-id="toggle_sidebar_label">Toggle Sidebar</span>
                </button>
                <div class="toolbarButtonSpacer"></div>
                <button id="viewFind" class="toolbarButton" title="Find in Document" tabindex="12" data-l10n-id="findbar" aria-expanded="false" aria-controls="findbar">
                  <span data-l10n-id="findbar_label">Find</span>
                </button>
                <div class="splitToolbarButton hiddenSmallView">
                  <button class="toolbarButton" title="Previous Page" id="previous" tabindex="13" data-l10n-id="previous">
                    <span data-l10n-id="previous_label">Previous</span>
                  </button>
                  <div class="splitToolbarButtonSeparator"></div>
                  <button class="toolbarButton" title="Next Page" id="next" tabindex="14" data-l10n-id="next">
                    <span data-l10n-id="next_label">Next</span>
                  </button>
                </div>
                <input type="number" id="pageNumber" class="toolbarField" title="Page" value="1" min="1" tabindex="15" data-l10n-id="page" autocomplete="off">
                <span id="numPages" class="toolbarLabel"></span>
              </div>
              <div id="toolbarViewerRight">
                <button id="openFile" class="toolbarButton hiddenLargeView" title="Open File" tabindex="31" data-l10n-id="open_file">
                  <span data-l10n-id="open_file_label">Open</span>
                </button>

                <button id="print" class="toolbarButton hiddenMediumView" title="Print" tabindex="32" data-l10n-id="print">
                  <span data-l10n-id="print_label">Print</span>
                </button>

                <button id="download" class="toolbarButton hiddenMediumView" title="Save" tabindex="33" data-l10n-id="save">
                  <span data-l10n-id="save_label">Save</span>
                </button>

                <div class="verticalToolbarSeparator hiddenMediumView"></div>

                <div id="editorModeButtons" class="splitToolbarButton toggled" role="radiogroup">
                  <button id="editorFreeText" class="toolbarButton" disabled="disabled" title="Text" role="radio" aria-checked="false" aria-controls="editorFreeTextParamsToolbar" tabindex="34" data-l10n-id="editor_free_text2">
                    <span data-l10n-id="editor_free_text2_label">Text</span>
                  </button>
                  <button id="editorInk" class="toolbarButton" disabled="disabled" title="Draw" role="radio" aria-checked="false" aria-controls="editorInkParamsToolbar" tabindex="35" data-l10n-id="editor_ink2">
                    <span data-l10n-id="editor_ink2_label">Draw</span>
                  </button>
                  <button id="editorStamp" class="toolbarButton hidden" disabled="disabled" title="Add or edit images" role="radio" aria-checked="false" aria-controls="editorStampParamsToolbar" tabindex="36" data-l10n-id="editor_stamp1">
                    <span data-l10n-id="editor_stamp1_label">Add or edit images</span>
                  </button>
                </div>

                <div id="editorModeSeparator" class="verticalToolbarSeparator"></div>

                <button id="secondaryToolbarToggle" class="toolbarButton" title="Tools" tabindex="48" data-l10n-id="tools" aria-expanded="false" aria-controls="secondaryToolbar">
                  <span data-l10n-id="tools_label">Tools</span>
                </button>
              </div>
              <div id="toolbarViewerMiddle">
                <div class="splitToolbarButton">
                  <button id="zoomOut" class="toolbarButton" title="Zoom Out" tabindex="21" data-l10n-id="zoom_out">
                    <span data-l10n-id="zoom_out_label">Zoom Out</span>
                  </button>
                  <div class="splitToolbarButtonSeparator"></div>
                  <button id="zoomIn" class="toolbarButton" title="Zoom In" tabindex="22" data-l10n-id="zoom_in">
                    <span data-l10n-id="zoom_in_label">Zoom In</span>
                   </button>
                </div>
                <span id="scaleSelectContainer" class="dropdownToolbarButton">
                  <select id="scaleSelect" title="Zoom" tabindex="23" data-l10n-id="zoom">
                    <option id="pageAutoOption" title="" value="auto" selected="selected" data-l10n-id="page_scale_auto">Automatic Zoom</option>
                    <option id="pageActualOption" title="" value="page-actual" data-l10n-id="page_scale_actual">Actual Size</option>
                    <option id="pageFitOption" title="" value="page-fit" data-l10n-id="page_scale_fit">Page Fit</option>
                    <option id="pageWidthOption" title="" value="page-width" data-l10n-id="page_scale_width">Page Width</option>
                    <option id="customScaleOption" title="" value="custom" disabled="disabled" hidden="true"></option>
                    <option title="" value="0.5" data-l10n-id="page_scale_percent" data-l10n-args='{ "scale": 50 }'>50%</option>
                    <option title="" value="0.75" data-l10n-id="page_scale_percent" data-l10n-args='{ "scale": 75 }'>75%</option>
                    <option title="" value="1" data-l10n-id="page_scale_percent" data-l10n-args='{ "scale": 100 }'>100%</option>
                    <option title="" value="1.25" data-l10n-id="page_scale_percent" data-l10n-args='{ "scale": 125 }'>125%</option>
                    <option title="" value="1.5" data-l10n-id="page_scale_percent" data-l10n-args='{ "scale": 150 }'>150%</option>
                    <option title="" value="2" data-l10n-id="page_scale_percent" data-l10n-args='{ "scale": 200 }'>200%</option>
                    <option title="" value="3" data-l10n-id="page_scale_percent" data-l10n-args='{ "scale": 300 }'>300%</option>
                    <option title="" value="4" data-l10n-id="page_scale_percent" data-l10n-args='{ "scale": 400 }'>400%</option>
                  </select>
                </span>
              </div>
            </div>
            <div id="loadingBar">
              <div class="progress">
                <div class="glimmer">
                </div>
              </div>
            </div>
          </div>
        </div>

        <div id="viewerContainer" tabindex="0">
          <div id="viewer" class="pdfViewer" ></div>
        </div>
      </div> <!-- mainContainer -->

      <div id="dialogContainer">
        <dialog id="passwordDialog">
          <div class="row">
            <label for="password" id="passwordText" data-l10n-id="password_label">Enter the password to open this PDF file:</label>
          </div>
          <div class="row">
            <input type="password" id="password" class="toolbarField">
          </div>
          <div class="buttonRow">
            <button id="passwordCancel" class="dialogButton"><span data-l10n-id="password_cancel">Cancel</span></button>
            <button id="passwordSubmit" class="dialogButton"><span data-l10n-id="password_ok">OK</span></button>
          </div>
        </dialog>
        <dialog id="documentPropertiesDialog">
          <div class="row">
            <span id="fileNameLabel" data-l10n-id="document_properties_file_name">File name:</span>
            <p id="fileNameField" aria-labelledby="fileNameLabel">-</p>
          </div>
          <div class="row">
            <span id="fileSizeLabel" data-l10n-id="document_properties_file_size">File size:</span>
            <p id="fileSizeField" aria-labelledby="fileSizeLabel">-</p>
          </div>
          <div class="separator"></div>
          <div class="row">
            <span id="titleLabel" data-l10n-id="document_properties_title">Title:</span>
            <p id="titleField" aria-labelledby="titleLabel">-</p>
          </div>
          <div class="row">
            <span id="authorLabel" data-l10n-id="document_properties_author">Author:</span>
            <p id="authorField" aria-labelledby="authorLabel">-</p>
          </div>
          <div class="row">
            <span id="subjectLabel" data-l10n-id="document_properties_subject">Subject:</span>
            <p id="subjectField" aria-labelledby="subjectLabel">-</p>
          </div>
          <div class="row">
            <span id="keywordsLabel" data-l10n-id="document_properties_keywords">Keywords:</span>
            <p id="keywordsField" aria-labelledby="keywordsLabel">-</p>
          </div>
          <div class="row">
            <span id="creationDateLabel" data-l10n-id="document_properties_creation_date">Creation Date:</span>
            <p id="creationDateField" aria-labelledby="creationDateLabel">-</p>
          </div>
          <div class="row">
            <span id="modificationDateLabel" data-l10n-id="document_properties_modification_date">Modification Date:</span>
            <p id="modificationDateField" aria-labelledby="modificationDateLabel">-</p>
          </div>
          <div class="row">
            <span id="creatorLabel" data-l10n-id="document_properties_creator">Creator:</span>
            <p id="creatorField" aria-labelledby="creatorLabel">-</p>
          </div>
          <div class="separator"></div>
          <div class="row">
            <span id="producerLabel" data-l10n-id="document_properties_producer">PDF Producer:</span>
            <p id="producerField" aria-labelledby="producerLabel">-</p>
          </div>
          <div class="row">
            <span id="versionLabel" data-l10n-id="document_properties_version">PDF Version:</span>
            <p id="versionField" aria-labelledby="versionLabel">-</p>
          </div>
          <div class="row">
            <span id="pageCountLabel" data-l10n-id="document_properties_page_count">Page Count:</span>
            <p id="pageCountField" aria-labelledby="pageCountLabel">-</p>
          </div>
          <div class="row">
            <span id="pageSizeLabel" data-l10n-id="document_properties_page_size">Page Size:</span>
            <p id="pageSizeField" aria-labelledby="pageSizeLabel">-</p>
          </div>
          <div class="separator"></div>
          <div class="row">
            <span id="linearizedLabel" data-l10n-id="document_properties_linearized">Fast Web View:</span>
            <p id="linearizedField" aria-labelledby="linearizedLabel">-</p>
          </div>
          <div class="buttonRow">
            <button id="documentPropertiesClose" class="dialogButton"><span data-l10n-id="document_properties_close">Close</span></button>
          </div>
        </dialog>
        <dialog id="altTextDialog" aria-labelledby="dialogLabel" aria-describedby="dialogDescription">
          <div id="altTextContainer">
            <div id="overallDescription">
              <span id="dialogLabel" data-l10n-id="editor_alt_text_dialog_label" class="title">Choose an option</span>
              <span id="dialogDescription" data-l10n-id="editor_alt_text_dialog_description">
                Alt text (alternative text) helps when people can’t see the image or when it doesn’t load.
              </span>
            </div>
            <div id="addDescription">
              <div class="radio">
                <div class="radioButton">
                  <input type="radio" id="descriptionButton" name="altTextOption" tabindex="0" aria-describedby="descriptionAreaLabel" checked>
                  <label for="descriptionButton" data-l10n-id="editor_alt_text_add_description_label">Add a description</label>
                </div>
                <div class="radioLabel">
                  <span id="descriptionAreaLabel" data-l10n-id="editor_alt_text_add_description_description">
                    Aim for 1-2 sentences that describe the subject, setting, or actions.
                  </span>
                </div>
              </div>
              <div class="descriptionArea">
                <textarea id="descriptionTextarea" placeholder="For example, “A young man sits down at a table to eat a meal”" aria-labelledby="descriptionAreaLabel" data-l10n-id="editor_alt_text_textarea" tabindex="0"></textarea>
              </div>
            </div>
            <div id="markAsDecorative">
              <div class="radio">
                <div class="radioButton">
                  <input type="radio" id="decorativeButton" name="altTextOption" aria-describedby="decorativeLabel">
                  <label for="decorativeButton" data-l10n-id="editor_alt_text_mark_decorative_label">Mark as decorative</label>
                </div>
                <div class="radioLabel">
                  <span id="decorativeLabel" data-l10n-id="editor_alt_text_mark_decorative_description">
                    This is used for ornamental images, like borders or watermarks.
                  </span>
                </div>
              </div>
            </div>
            <div id="buttons">
              <button id="altTextCancel" tabindex="0"><span data-l10n-id="editor_alt_text_cancel_button">Cancel</span></button>
              <button id="altTextSave" tabindex="0"><span data-l10n-id="editor_alt_text_save_button">Save</span></button>
            </div>
          </div>
        </dialog>
        <dialog id="printServiceDialog" style="min-width: 200px;">
          <div class="row">
            <span data-l10n-id="print_progress_message">Preparing document for printing…</span>
          </div>
          <div class="row">
            <progress value="0" max="100"></progress>
            <span data-l10n-id="print_progress_percent" data-l10n-args='{ "progress": 0 }' class="relative-progress">0%</span>
          </div>
          <div class="buttonRow">
            <button id="printCancel" class="dialogButton"><span data-l10n-id="print_progress_close">Cancel</span></button>
          </div>
        </dialog>
      </div>  <!-- dialogContainer -->

    </div> <!-- outerContainer -->
    <div id="printContainer"></div>

    <input type="file" id="fileInput" class="hidden">
	<script type="text/javascript">
	  const { PDFDocument } = PDFLib;
	  var elementNames=[];
	  var {FlattenImgArr}=globalThis;
	  var {NextButtonCount}=globalThis;
	  var {Flatten64}=globalThis;
	  FlattenImgArr=[];
	  Flatten64=[];
	  NextButtonCount=0;
	  let startTime;
	var {imgId}=globalThis;
      $('img[data-toggle="modal"]').on('click', function () {
         imgId = $(this).attr('id');
		
        console.log('Image clicked:', imgId);
      });	
	  function startTimer() {
		startTime = new Date();
		console.log('Timer started at: ' + startTime);
		sleep(500);
		const containerDiv = document.getElementById('viewer');
		containerDiv.click();
		containerDiv.scrollIntoView();
		containerDiv.scrollIntoView();
		document.getElementById('nextButton').disabled = false;
		document.getElementById('startButton').disabled = true; 
		document.getElementById('startButton').style.backgroundColor = "grey";
		document.getElementById('finishButton').disabled = false; 
		document.getElementById('finishButton').style.backgroundColor = "green";
		document.getElementById('nextButton').style.backgroundColor = "green";
    }
	
	
	    async function finishTimer() {
      if (!startTime) {
        console.error('Timer not started.');
        return;
      }

      const finishTime = new Date();
      const timeDifference = finishTime - startTime;
	   const elements = document.querySelectorAll('[name]');
	   elements.forEach(element => {
		   const elementName = element.name; console.log(elementName);
		   if (elementName.indexOf("signed_img")>-1){
			   FlattenImgArr.push(elementName);
			   Flatten64.push(element.src);
			   
		   }
	   });
	   if (FlattenImgArr.length==0){
		   alert("Please Sign");
		    return;
	   }



       document.getElementById('download').click();

      console.log('Timer finished at: ' + finishTime);
      console.log('Time difference: ' + timeDifference + ' milliseconds');

      document.getElementById("loading").style.visibility = "visible";

    }
	
	async function flattenForm(){
			   
			   //const formUrl = '/NewPDF/pdfjs/screenshots/compressed.tracemonkey-pldi-09.pdf'
         //const formUrl = 'screenshots/compressed.tracemonkey-pldi-09.pdf'
        var doc_id=document.getElementById('txt_document_id').value;
        var form_id = document.getElementById('txt_form_id').value;
        //const formUrl = 'screenshots/'+doc_id+"_"+form_id+".pdf";
        const formUrl = 'signed_pdf_files/'+doc_id+"_"+form_id+".pdf";


			   const formPdfBytes = await fetch(formUrl).then(res => res.arrayBuffer())	
			   const pdfDoc1 = await PDFDocument.load(formPdfBytes)
			   const form = pdfDoc1.getForm()
			   for (var i=0;i<FlattenImgArr.length;i++){
				    var imgField=null;var tmpimgId =null;
					for (var j=0;j<elementNames.length;j++){
					   tmpimgId=FlattenImgArr[i].replace("signed_img_lab","Img");
					   if(tmpimgId== elementNames[j]){
						   try{
							    imgField = form.getButton(tmpimgId ); 
								
							}catch(e){}	
							if( imgField!=null  ){
								const ImgBytes1 = base64ToArrayBuffer(Flatten64[i]);
								const emblemImage = await pdfDoc1.embedPng(ImgBytes1)
								console.log('set Image ID:', tmpimgId);
								imgField.setImage(emblemImage);
								
								}
					   }
					}
			}
			form.flatten();
			const pdfBytes = await pdfDoc1.save();
			var pdfBlob = new Blob([pdfBytes], { type: 'application/pdf' });
			var ajax = new XMLHttpRequest();
			var formData = new FormData();
      //var doc_id=document.getElementById('txt_document_id').value;
      //var form_id = document.getElementById('txt_form_id').value;
			//formData.append('pdfFile', pdfBlob, 'compressed.tracemonkey-pldi-09_signed.pdf');
			formData.append('pdfFile', pdfBlob, doc_id+"_"+form_id+".pdf");
			
      //alert("this is second save call");
      //ajax.open('POST', 'save_file?id=compressed.tracemonkey-pldi-09_signed', true);
      ajax.open('POST', "save_flatten_file?document_id="+doc_id+"&form_id="+form_id, true);
			//ajax.setRequestHeader('enctype', 'multipart/form-data');
      ajax.setRequestHeader("X-CSRF-TOKEN",document.getElementById('csrf-token').value);
			ajax.send(formData);
			ajax.onreadystatechange = function()
      {
        if(this.readyState==4 && this.status==200)
        {
          
          //alert("Review submitted Successfully");
          //location.reload();
          console.log("Review submitted Successfully");

          var document_id=document.getElementById('txt_document_id').value;
          var form_id = document.getElementById('txt_form_id').value;
          //joinPdf(document_id+"_"+form_id+".pdf");
          setTimeout(function(){
            joinPdf(document_id+"_"+form_id+".pdf");
          },4000);
          /*
          //$("#btn_join").click();
          var document_id=document.getElementById('txt_document_id').value;
          var form_id = document.getElementById('txt_form_id').value;
          joinPdf(document_id+"_"+form_id+".pdf");
          */

          
          /*
          setTimeout(function() {
             location.reload();
          }, 10000);
          */
          
        }   
      }
				   
	}
	function base64ToArrayBuffer(base64) {
			var bse641=base64.split(',')[1];
			var bse64=bse641.replace(/^.+,/, '');
			const binaryString = window.atob(bse64);
			const length = binaryString.length;
			const buffer = new ArrayBuffer(length);
			const array = new Uint8Array(buffer);

			for (let i = 0; i < length; i++) {
				array[i] = binaryString.charCodeAt(i);
			}

			return buffer;
	}

	
	
	
	
	document.addEventListener('DOMContentLoaded', function () {
        const containerDiv = document.getElementById('viewer');
		containerDiv.click();
		containerDiv.scrollIntoView();
		containerDiv.scrollIntoView();
		if (containerDiv) {   
		 var intervalId = setInterval(function () {
			var formElements = containerDiv.querySelectorAll('input, textarea, select, button');
			if (formElements.length > 0) {
				formElements.forEach(function (element) {
					element.disabled = true;
				});
				 clearInterval(intervalId);
			}
		   }, 100); 	
		}
	async function fillTxbox(){
			//const formUrl = '/NewPDF/pdfjs/compressed.tracemonkey-pldi-09.pdf'
      const formUrl = new_file_name
      
			const formPdfBytes = await fetch(formUrl).then(res => res.arrayBuffer())
		  
			const pdfDoc1 = await PDFDocument.load(formPdfBytes)
			const totalPages = pdfDoc1.getPageCount(); console.log("No of Pages"+totalPages);
			const form = pdfDoc1.getForm();
			const fields = form.getFields()
			fields.forEach(field => {
			  const type = field.constructor.name
			  const name = field.getName()
			  elementNames.push(name);
			  })	
	
		
	}
	  window.onload = fillTxbox;	
      let currentIndex = 0;
	  let currentIndex_nxt=-1;
      const nextButton = document.getElementById('nextButton');
      nextButton.addEventListener('click', function () {

		const containerDiv = document.getElementById('viewer');
		containerDiv.click();

		containerDiv.scrollIntoView();
		if (containerDiv) {  
			const textboxes = containerDiv.querySelectorAll('input[type="text"]');
			const textboxNames = [];
			textboxes.forEach(function (textbox) {
			const name = textbox.getAttribute('name');
			if (name) {
			textboxNames.push(name);
			}
		
	  });
	  }
		
		var indx=1;
		
		for (var i=0;i<elementNames.length;i++){
			var isPartialMatch = elementNames.findIndex(function(element) {
				return element.startsWith("lab_sign");
						});
			console.log(` partial: ${isPartialMatch}:   ${elementNames[isPartialMatch]}`)	
			const currentName = elementNames[isPartialMatch];			
			const textboxElement = document.querySelector(`[name="${currentName}"]`);
			const computedStyle = window.getComputedStyle(textboxElement);
			if ((isPartialMatch || elementNames[isPartialMatch]!=undefined) ) {
				if(!textboxElement.name || textboxElement.name!="" || textboxElement.name!=undefined){	
					if (textboxElement && indx<2 && NextButtonCount<1){
							
							const imgHTML = `<img src="sign.png" class="visible-image" data-toggle="modal" data-target="#myModal" id="img_${textboxElement.name}" name ="img_${textboxElement.name}" style="position: absolute; left: ${textboxElement.offsetLeft + textboxElement.offsetWidth}px; top: ${textboxElement.offsetTop}px;">`;
							textboxElement.insertAdjacentHTML('afterend', imgHTML);
							const imgElement = document.getElementById(`img_${textboxElement.name}`);
								
							
							imgId = imgElement.id;
							indx=indx+1;	
							imgElement.addEventListener("click", () => {
							console.log('Image clicked:', imgId);
							
												
							});

						  
						  }
						  }
				  }
				  NextButtonCount=NextButtonCount+1;
		}	

	  
		const textboxes = document.querySelectorAll('input[type="text"]');

        const existingArrows = document.querySelectorAll('.arrow');
        existingArrows.forEach(arrow => arrow.remove());
		var tmpCelement=elementNames[currentIndex];
		var tmpPelement=elementNames[currentIndex-1];
		var tmpvalue;
		if( elementNames[currentIndex].indexOf("lab_sign")>-1 ){ 
			document.querySelector(`[name="${elementNames[currentIndex]}"]`).value="   ";
			tmpCelement="img_"+tmpCelement;
			tmpPelement="img_"+tmpPelement;
			document.querySelector(`[name="${tmpCelement}"]`).click();
		}
		else if(elementNames[currentIndex].indexOf("Img_sign")>-1){ 
			tmpCelement=tmpCelement;
			tmpPelement=tmpPelement;
			currentIndex = (currentIndex + 1) % elementNames.length;
		    currentIndex_nxt  = (currentIndex_nxt + 1) % elementNames.length;
			return nextButton.click();
		}
        const currentName = tmpCelement;
		const prevName = tmpPelement
        const currentElement = document.querySelector(`[name="${currentName}"]`);
		const prevElement = document.querySelector(`[name="${prevName}"]`);
		if(prevElement!=null){
			if (prevElement.tagName.toLowerCase() === 'select') { 
				tmpDrpdwn=/^\s*$/.test(prevElement.options[prevElement.selectedIndex].value);
				if(prevElement.selectedIndex !=-1 && !tmpDrpdwn ){
					tmpvalue="1";
				}else{
					tmpvalue="";
				}
			}
			else if (prevElement.tagName.toLowerCase() === 'input') {
				tmpvalue=prevElement.value;
			}
		}
		//var tmpprevel;
		//try{tmpprevel=prevElement.checked}catch(e){tmpprevel=false}
        
		if ((currentElement ) && ( ( (prevElement==null  && currentIndex==0) || ((tmpvalue!=""  ) &&  currentIndex > 0 )))) {
		  currentElement.disabled = false; //if( prevElement!=null){alert(currentElement.name+" prev : "+prevElement.name);}
          const arrow = document.createElement('span');
          arrow.className = 'arrow';
          arrow.innerHTML = '&#9664;'; 
          currentElement.insertAdjacentElement('afterend', arrow);
	      arrow.style.position = 'relative'; 
          arrow.style.left = '10px';  
		  const elementWidth = currentElement.offsetWidth;	
		  arrow.style.marginLeft =`${elementWidth}px`;
          currentIndex = (currentIndex + 1) % elementNames.length;
		  currentIndex_nxt  = (currentIndex_nxt + 1) % elementNames.length; 
          const nextName = elementNames[currentIndex_nxt];
          const nextElement = document.querySelector(`[name="${nextName}"]`);
          if (nextElement) {
            nextElement.focus();
          }
		 } 
        
      });
    });
	function sleep(ms) {
  const start = Date.now();
  while (Date.now() - start < ms) {}
}

</script>



  <div class="modal fade" id="myModal"  aria-hidden="true">
    <div class="modal-dialog ">
		
      <div class="modal-content">
	      <button type="button" class="close" data-dismiss="modal" style="display:none">&times;</button>
                          <!--<label style="margin-top:10px;font-size:24px;font-weight:bold;margin-left:20px">Please sign below</label>
	                        <hr>-->
						              <input type="hidden" id="selected_div">
                          <script type="text/javascript">
                            function update_data(val)
                            {
                              $(".update-text").text(val);
                            }
                            
                            $(document).on('click', '.update-text', function(element) {
                              $('td').removeClass("selected-text");
                              $("#selected_div").val($(this).closest('div').attr('id'));
                              $(this).closest('td').addClass("selected-text");
                            });
                          </script>
						
        <div class="modal-body">
          <!--<nav class="nav nav-tabs" id="nav-tab" role="tablist">
				
                     <ul class="nav nav-tabs">
                          <li id="menu1_li" class="tab-link mr-2"><a data-toggle="tab" href="#menu1">Upload Image</a></li>
                          <li id="menu2_li" class="tab-link mr-2"><a data-toggle="tab" href="#menu2">Draw</a></li>
                          <li id="menu3_li" class="active tab-link mr-2"><a data-toggle="tab" href="#menu3">Type</a></li>
                        </ul>

          </nav>-->
          <div class="tab-content" >
            <div id="menu1"  class="tab-pane fade">
                            <center>
                              <div style="width:620px;height:160px;border:1px black solid;border:2px dotted #CCCCCC;border-radius: 15px;margin:10px">
                                <p  style="margin-top:25px;font-weight:bold;margin-bottom:25px">Upload File</p>
                                <input type="file">
                              </div>
                            </center>
                          </div>
                          <div id="menu2" class="tab-pane fade">
                            
                            <link rel="stylesheet" href="draw_signature/style.css">
                            <center>
                              <p  style="margin-top:25px;font-weight:bold;margin-bottom:25px">Draw Signatures</p>
                              <canvas id="sig-canvas" width="370" height="120">
                              Get a better browser, bro.
                              </canvas>
                              <div class="row">
                                <div class="col-md-12" style="margin-top:10px">
                                  <button class="btn btn-primary" id="sig-submitBtn" onclick="sign()">Save Signature</button>
                                  <script type="text/javascript">
                                    function sign()
                                    {
                                     var canvas = document.getElementById("sig-canvas");
                                      var style = $("#img_sign_btn").attr("style");//img_id
                                      $("#img_sign_btn").replaceWith("<img id='imgsign_1_pg2' src='"+canvas.toDataURL()+"' style='"+style+";max-width:250px' crossorigin='anonymous'>");
                                      
                                      $("#myModal .close").click();
                                    }
                                  </script>
                                  <button class="btn btn-default" id="sig-clearBtn">Clear Signature</button>
                                </div>
                              </div>
                            </center>
                            
                            <br/>
                            <div style="display:none">
                              <div class="row">
                                <div class="col-md-12">
                                  <textarea id="sig-dataUrl" class="form-control" rows="5">Data URL for your signature will go here!</textarea>
                                </div>
                              </div>
                              <br/>
                              <div class="row">
                                <div class="col-md-12">
                                  <img id="sig-image" src="" alt="Your signature will go here!"/>
                                </div>
                              </div>
                            </div>
                              <script  src="draw_signature//script.js"></script>



                            <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
                          </div>
                          <!--<div id="menu3_old" class="tab-pane fade">
                              <link rel="preconnect" href="https://fonts.googleapis.com">
                              <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
                              <link rel="preconnect" href="https://fonts.googleapis.com">
                              <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
                              <link href="https://fonts.googleapis.com/css2?family=Festive&family=Arizonia&family=Edu+TAS+Beginner&family=Great+Vibes&family=Italianno&family=La+Belle+Aurore&family=Mr+Dafoe&family=Mrs+Saint+Delafield&family=My+Soul&family=Roboto:wght@300&family=Yellowtail&display=swap" rel="stylesheet">

                              <style type="text/css">
                                
                                  .tas-edu
                                  {
                                      font-family: 'Edu TAS Beginner', cursive;
                                  }
                                  .great-vibes
                                  {
                                      font-family: 'Great Vibes', cursive;
                                  }
                                  .mr-dafoe
                                  {
                                      font-family: 'Mr Dafoe', cursive;
                                  }
                                  .Arizonia
                                  {
                                      font-family: 'Arizonia', sans-serif;
                                  }
                                  .yellowtail
                                  {
                                      font-family: 'Yellowtail', cursive;
                                  }
                                  .italiano
                                  {
                                      font-family: 'Italianno', cursive;
                                  }
                                  .mrs-saint
                                  {
                                      font-family: 'Mrs Saint Delafield', cursive;
                                  }
                                  .my-soul
                                  {
                                      font-family: 'My Soul', cursive;
                                  }
                                  .labella
                                  {
                                      font-family : 'La Belle Aurore',cursive;
                                  }
                                  .festive
                                  {
                                      font-family : 'Festive',cursive;
                                  }
                                  td
                                  {
                                      
                                      border:1px gray solid;
                                      
                                  }
                              </style>
                              <center>
                                <div style="margin-bottom:20px;margin-top:20px">
                                  Enter Name : <input type="text" id="txtentername" style="height:25px;font-size:20px;border:2px gray solid;border-radius:10px;padding-left:15px !important" onkeyup="update_data(this.value)">
                                  <input type="text" id="getbuttonid" hidden/> 
								                </div>
                              </center>
                                
                              <table style="width:100% !important" >
                                  <tr>
                                      <td>
                                        <div id="div1">
                                          <h1 class="tas-edu update-text">Mitchell Johnson</h1>
                                        </div>
                                      </td>
                                      <td>
                                        <div id="div2">
                                          <h1 class="great-vibes update-text">Mitchell Johnson</h1>
                                        </div>
                                      </td>
                                  </tr>
                                  <tr>
                                      <td>
                                        <div id="div3">
                                          <h1 class="mr-dafoe update-text">Mitchell Johnson</h1>
                                        </div>
                                      </td>
                                      <td>
                                        <div id="div4">
                                          <h1 class="Arizonia update-text">Mitchell Johnson</h1>
                                        </div>
                                      </td>
                                  </tr>
                                  <tr>
                                      <td>
                                        <div id="div5">
                                          <h1 class="yellowtail update-text">Mitchell Johnson</h1>
                                        </div>
                                      </td>
                                      <td>
                                        <div id="div6">
                                          <h1 class="italiano update-text">Mitchell Johnson</h1>
                                        </div>
                                      </td>
                                  </tr>
                                  <tr>
                                      <td>
                                        <div id="div7">
                                          <h1 class="labella update-text">Mitchell Johnson</h1>
                                        </div>
                                      </td>
                                      <td>
                                        <div id="div8">
                                          <h1 class="mrs-saint update-text">Mitchell Johnson</h1>
                                        </div>
                                      </td>
                                  </tr>
                                  <tr>
                                      <td>
                                        <div id="div9">
                                          <h1 class="my-soul update-text">Mitchell Johnson</h1>
                                        </div>
                                      </td>
                                      <td>
                                        <div id="div10">
                                          <h1 class="festive update-text">Mitchell Johnson</h1>
                                        </div>
                                      </td>
                                  </tr>
                              </table>
                              <button type="button" style="border-radius:10px;margin-top:10px;float:right" class="btn btn-primary" onclick="savesign()" >Save Signature</button>
                              <script>
                                function savesign()
                                {
                                  var div_id = $("#selected_div").val();
                                  downloadimage(div_id);
                                }

                                function downloadimage(div_id) {
                                    var container = document.getElementById(div_id); 
                                    html2canvas(container, { }).then(function (canvas) {
                                    var tmpid="#"+imgId;//img_sign_1_pg1
                                    var imgId1="signed_"+imgId;
                                    var style = $(tmpid).attr("style");
                                    
                                        $(tmpid).replaceWith("<img id='"+imgId1+"' name='"+imgId1+"' src='"+canvas.toDataURL()+"' style='"+style+";max-width:250px' crossorigin='anonymous'>");
                                        
                                    });
                                  $("#myModal .close").click();
                                    //added by sandip
                                    
                                    //alert("image set");
                                    $("#nextButton").css("display", "none");
                                    $("#finishButton").css("display", "block");
                                    //added by sandip
                                  console.log("dwnldimage");
                                }
                              </script>
                          </div>
                          -->

                          <div id="menu3" class="tab-pane fade show in active">
                              <!--<h3>Menu 3</h3>-->
                              <link rel="preconnect" href="https://fonts.googleapis.com">
                              <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
                              <link rel="preconnect" href="https://fonts.googleapis.com">
                              <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
                              <link href="https://fonts.googleapis.com/css2?family=Festive&family=Arizonia&family=Edu+TAS+Beginner&family=Great+Vibes&family=Italianno&family=La+Belle+Aurore&family=Mr+Dafoe&family=Mrs+Saint+Delafield&family=My+Soul&family=Roboto:wght@300&family=Yellowtail&display=swap" rel="stylesheet">

                              <style type="text/css">
                                
                                  .tas-edu
                                  {
                                      font-family: 'Edu TAS Beginner', cursive;
                                  }
                                  .great-vibes
                                  {
                                      font-family: 'Great Vibes', cursive;
                                  }
                                  .mr-dafoe
                                  {
                                      font-family: 'Mr Dafoe', cursive;
                                  }
                                  .Arizonia
                                  {
                                      font-family: 'Arizonia', sans-serif;
                                  }
                                  .yellowtail
                                  {
                                      font-family: 'Yellowtail', cursive;
                                  }
                                  .italiano
                                  {
                                      font-family: 'Italianno', cursive;
                                  }
                                  .mrs-saint
                                  {
                                      font-family: 'Mrs Saint Delafield', cursive;
                                  }
                                  .my-soul
                                  {
                                      font-family: 'My Soul', cursive;
                                  }
                                  .labella
                                  {
                                      font-family : 'La Belle Aurore',cursive;
                                  }
                                  .festive
                                  {
                                      font-family : 'Festive',cursive;
                                  }
                                  td
                                  {
                                      
                                      border:1px gray solid;
                                      
                                  }
                              </style>
                              <!--<center>
                                <div style="margin-bottom:20px;margin-top:20px">
                                  Enter Name : <input type="text" id="txtentername" style="height:25px;font-size:20px;border:2px gray solid;border-radius:10px;padding-left:15px !important" onkeyup="update_data(this.value)">
                                  <input type="text" id="getbuttonid" hidden/> 
								                </div>
                              </center>-->
                              <div class="row">
                                <div class="col-md-12">
                                  <center><label style="font-size:18px;font-weight:bold;" class="mb-3">Please sign below</label></center>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-7">
                                  <input type="text" id="txt_entername" name="txt_entername"  onkeyup="update_data(this.value)" class="form-control" placeholder="Asfwe Rweren">
                                </div>
                                <div class="col-md-5">
                                  <select class="form-control" onchange="update_style(this.value)">
                                    <option value="tas-edu">tas-edu</option>
                                    <option value="great-vibes">great-vibes</option>
                                    <option value="mr-dafoe">mr-dafoe</option>
                                    <option value="Arizonia">Arizonia</option>
                                    <option value="yellowtail">yellowtail</option>
                                    <option value="italiano">italiano</option>
                                    <option value="labella">labella</option>
                                    <option value="mrs-saint">mrs-saint</option>
                                    <option value="my-soul">my-soul</option>
                                    <option value="festive">festive</option>
                                    
                                  </select>
                                  <script type="text/javascript">
                                    function update_style(style_name)
                                    {
                                      /*
                                      alert($("#txt_entername").val());
                                      alert(style_name);
                                      */

                                      $("#txt_print").removeClass();
                                      $("#txt_print").addClass("update-text");
                                      $("#txt_print").addClass(style_name);

                                      


                                    }
                                  </script>
                                </div>
                              </div>
                              <div class="row" style="padding:20px" >
                                <div class="col-md-12 sign_demo" >
                                  <div>
                                    <div id="div_sign" >
                                      <center><h1 id="txt_print" class="tas-edu update-text">Asfwe Rweren</h1></center>
                                    </div>
                                  </div>
                                </div>
                                <style type="text/css">
                                  .sign_demo { 
                                      /*height: 300px; */
                                      height:130px !important;
                                      /*width: 645px; */
                                      display: flex; 
                                      justify-content: center; 
                                      align-items: center; 
                                      border: 1px solid #ced4da; 
                                      
                                  } 
                                </style>
                              </div>
                              <!--
                              <table style="width:100% !important" >
                                  <tr>
                                      <td>
                                        <div id="div1">
                                          <h1 class="tas-edu update-text">Mitchell Johnson</h1>
                                        </div>
                                      </td>
                                      <td>
                                        <div id="div2">
                                          <h1 class="great-vibes update-text">Mitchell Johnson</h1>
                                        </div>
                                      </td>
                                  </tr>
                                  <tr>
                                      <td>
                                        <div id="div3">
                                          <h1 class="mr-dafoe update-text">Mitchell Johnson</h1>
                                        </div>
                                      </td>
                                      <td>
                                        <div id="div4">
                                          <h1 class="Arizonia update-text">Mitchell Johnson</h1>
                                        </div>
                                      </td>
                                  </tr>
                                  <tr>
                                      <td>
                                        <div id="div5">
                                          <h1 class="yellowtail update-text">Mitchell Johnson</h1>
                                        </div>
                                      </td>
                                      <td>
                                        <div id="div6">
                                          <h1 class="italiano update-text">Mitchell Johnson</h1>
                                        </div>
                                      </td>
                                  </tr>
                                  <tr>
                                      <td>
                                        <div id="div7">
                                          <h1 class="labella update-text">Mitchell Johnson</h1>
                                        </div>
                                      </td>
                                      <td>
                                        <div id="div8">
                                          <h1 class="mrs-saint update-text">Mitchell Johnson</h1>
                                        </div>
                                      </td>
                                  </tr>
                                  <tr>
                                      <td>
                                        <div id="div9">
                                          <h1 class="my-soul update-text">Mitchell Johnson</h1>
                                        </div>
                                      </td>
                                      <td>
                                        <div id="div10">
                                          <h1 class="festive update-text">Mitchell Johnson</h1>
                                        </div>
                                      </td>
                                  </tr>
                              </table>
                              -->
                              <!--<button type="button" style="border-radius:10pxfloat:right" class="btn btn-primary" onclick="savesign()" >Add Signature</button>-->
                              <button type="button" class="btn btn-warning btn-sm"  onclick="savesign()" style="float:right" ><i class="bi bi-vector-pen me-1"></i>Add Signature</button>
                              
                              <script>
                                function savesign()
                                {
                                  /*
                                  var div_id = $("#selected_div").val();
                                  downloadimage(div_id);
                                  */
                                  //div_sign
                                  //var div_id = $("#div_sign").val();
                                  downloadimage("div_sign");
                                }

                                function downloadimage(div_id) {
                                    var container = document.getElementById(div_id); 
                                    html2canvas(container, { }).then(function (canvas) {
                                    var tmpid="#"+imgId;//img_sign_1_pg1
                                    var imgId1="signed_"+imgId;
                                    var style = $(tmpid).attr("style");
                                    
                                        $(tmpid).replaceWith("<img id='"+imgId1+"' name='"+imgId1+"' src='"+canvas.toDataURL()+"' style='"+style+";max-width:250px' crossorigin='anonymous'>");
                                        
                                    });
                                  $("#myModal .close").click();
                                    //added by sandip
                                    
                                    //alert("image set");
                                    $("#nextButton").css("display", "none");
                                    $("#finishButton").css("display", "block");
                                    //added by sandip
                                  console.log("dwnldimage");
                                }
                              </script>
                          </div>
                          
                        </div>
                        <!--tab end -->


                        

                      </div>
                      
                      
                    </div>
                  </div>
                </div>
                <style type="text/css">
                  .modal-open {
                    overflow: hidden;
                  }

                  .modal-open .modal {
                    overflow-x: hidden;
                    overflow-y: auto;
                  }

                  .modal {
                    position: fixed;
                    top: 0;
                    left: 0;
                    z-index: 1050;
                    display: none;
                    width: 100%;
                    height: 100%;
                    overflow: hidden;
                    outline: 0;
                  }

                  .modal-dialog {
                    position: relative;
                    width: auto;
                    margin: 0.5rem;
                    pointer-events: none;
                  }

                  .modal.fade .modal-dialog {
                    transition: -webkit-transform 0.3s ease-out;
                    transition: transform 0.3s ease-out;
                    transition: transform 0.3s ease-out, -webkit-transform 0.3s ease-out;
                    -webkit-transform: translate(0, -50px);
                    transform: translate(0, -50px);
                  }

                  @media (prefers-reduced-motion: reduce) {
                    .modal.fade .modal-dialog {
                      transition: none;
                    }
                  }

                  .modal.show .modal-dialog {
                    -webkit-transform: none;
                    transform: none;
                  }

                  .modal.modal-static .modal-dialog {
                    -webkit-transform: scale(1.02);
                    transform: scale(1.02);
                  }

                  .modal-dialog-scrollable {
                    display: -ms-flexbox;
                    display: flex;
                    max-height: calc(100% - 1rem);
                  }

                  .modal-dialog-scrollable .modal-content {
                    max-height: calc(100vh - 1rem);
                    overflow: hidden;
                  }

                  .modal-dialog-scrollable .modal-header,
                  .modal-dialog-scrollable .modal-footer {
                    -ms-flex-negative: 0;
                    flex-shrink: 0;
                  }

                  .modal-dialog-scrollable .modal-body {
                    overflow-y: auto;
                  }

                  .modal-dialog-centered {
                    display: -ms-flexbox;
                    display: flex;
                    -ms-flex-align: center;
                    align-items: center;
                    min-height: calc(100% - 1rem);
                  }

                  .modal-dialog-centered::before {
                    display: block;
                    height: calc(50vh - 1rem);
                    height: -webkit-min-content;
                    height: -moz-min-content;
                    height: min-content;
                    content: "";
                  }

                  .modal-dialog-centered.modal-dialog-scrollable {
                    -ms-flex-direction: column;
                    flex-direction: column;
                    -ms-flex-pack: center;
                    justify-content: center;
                    height: 50%;
                  }

                  .modal-dialog-centered.modal-dialog-scrollable .modal-content {
                    max-height: none;
                  }

                  .modal-dialog-centered.modal-dialog-scrollable::before {
                    content: none;
                  }

                  .modal-content {
                    position: relative;
                    display: -ms-flexbox;
                    display: flex;
                    -ms-flex-direction: column;
                    flex-direction: column;
                    width: 100%;
                    pointer-events: auto;
                    background-color: #fff;
                    background-clip: padding-box;
                    border: 1px solid rgba(0, 0, 0, 0.2);
                    border-radius: 0.3rem;
                    outline: 0;
                  }

                  .modal-backdrop {
                    position: fixed;
                    top: 0;
                    left: 0;
                    z-index: 1040;
                    width: 100vw;
                    height: 100vh;
                    background-color: #000;
                  }

                  .modal-backdrop.fade {
                    opacity: 0;
                  }

                  .modal-backdrop.show {
                    opacity: 0.5;
                  }

                  .modal-header {
                    display: -ms-flexbox;
                    display: flex;
                    -ms-flex-align: start;
                    align-items: flex-start;
                    -ms-flex-pack: justify;
                    justify-content: space-between;
                    padding: 1rem 1rem;
                    border-bottom: 1px solid #dee2e6;
                    border-top-left-radius: calc(0.3rem - 1px);
                    border-top-right-radius: calc(0.3rem - 1px);
                  }

                  .modal-header .close {
                    padding: 1rem 1rem;
                    margin: -1rem -1rem -1rem auto;
                  }

                  .modal-title {
                    margin-bottom: 0;
                    line-height: 1.5;
                  }

                  .modal-body {
                    position: relative;
                    -ms-flex: 1 1 auto;
                    flex: 1 1 auto;
                    padding: 1rem;
                  }

                  .modal-footer {
                    display: -ms-flexbox;
                    display: flex;
                    -ms-flex-wrap: wrap;
                    flex-wrap: wrap;
                    -ms-flex-align: center;
                    align-items: center;
                    -ms-flex-pack: end;
                    justify-content: flex-end;
                    padding: 0.75rem;
                    border-top: 1px solid #dee2e6;
                    border-bottom-right-radius: calc(0.3rem - 1px);
                    border-bottom-left-radius: calc(0.3rem - 1px);
                  }

                  .modal-footer > * {
                    margin: 0.25rem;
                  }

                  .modal-scrollbar-measure {
                    position: absolute;
                    top: -9999px;
                    width: 50px;
                    height: 50px;
                    overflow: scroll;
                  }

                  @media (min-width: 576px) {
                    .modal-dialog {
                      max-width: 500px;
                      margin: 1.75rem auto;
                    }
                    .modal-dialog-scrollable {
                      max-height: calc(100% - 3.5rem);
                    }
                    .modal-dialog-scrollable .modal-content {
                      max-height: calc(100vh - 3.5rem);
                    }
                    .modal-dialog-centered {
                      min-height: calc(100% - 3.5rem);
                    }
                    .modal-dialog-centered::before {
                      height: calc(100vh - 3.5rem);
                      height: -webkit-min-content;
                      height: -moz-min-content;
                      height: min-content;
                    }
                    .modal-sm {
                      max-width: 300px;
                    }
                    @media (min-width: 992px) {
                      .modal-lg,
                      .modal-xl {
                        max-width: 800px;
                      }
                    }

                    @media (min-width: 1200px) {
                      .modal-xl {
                        max-width: 1140px;
                      }
                    }
                  }

                </style>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Festive&family=Arizonia&family=Edu+TAS+Beginner&family=Great+Vibes&family=Italianno&family=La+Belle+Aurore&family=Mr+Dafoe&family=Mrs+Saint+Delafield&family=My+Soul&family=Roboto:wght@300&family=Yellowtail&display=swap" rel="stylesheet">

<style type="text/css">
   
    .tas-edu
    {
        font-family: 'Edu TAS Beginner', cursive;
    }
    .great-vibes
    {
        font-family: 'Great Vibes', cursive;
    }
    .mr-dafoe
    {
        font-family: 'Mr Dafoe', cursive;
    }
    .Arizonia
    {
        font-family: 'Arizonia', sans-serif;
    }
    .yellowtail
    {
        font-family: 'Yellowtail', cursive;
    }
    .italiano
    {
        font-family: 'Italianno', cursive;
    }
    .mrs-saint
    {
        font-family: 'Mrs Saint Delafield', cursive;
    }
    .my-soul
    {
        font-family: 'My Soul', cursive;
    }
    .labella
    {
        font-family : 'La Belle Aurore',cursive;
    }
    .festive
    {
        font-family : 'Festive',cursive;
    }
    table
    {
      border-spacing: 5px !important;
    }
    td
    {
        /*
        padding:20px;
        */
        border:1px gray dotted !important;
        margin:20px !important;
        border-radius: 10px;
        
        
    }

    .toolbar {
      z-index:0 !important;
    }

    table td {
      text-align: center;
      height:50px !important;
    } 

    td:hover,h1:hover
    {
      background-color:black !important;
      color:white !important;
    }

    .selected-text
    {
      background-color:black !important;
      color:white !important;
    }

    h1
    {
      color:black !important;
    }


    .selected-text h1
    {
      color:red !important;
    }
    


</style>
  </body>
</html>

<input type="text" id="txt_data" name="txt_data" style="display:none">
<input type="button" value="Download File" onclick="downloadfile()" style="display:none">
<script type="text/javascript">
  function downloadfile()
  {
    document.getElementById('download').click();
  }
</script>

