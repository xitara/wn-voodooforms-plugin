<?php

return [
    'plugin' => [
        'name' => 'VoodooForms',
        'description' => '',
    ],
    'submenu' => [
        'label' => 'Formular Builder',
        'description' => 'Globale Einstellungen für VoodooForms',
        'forms' => 'Formulare',
        'submissions' => 'Übertragene Formular-Daten',
    ],
    'tabs' => [
        'fields' => 'Felder',
        'privacy' => 'Privatsphäre',
        'antispam' => 'Antispam',
        'styling' => 'Aussehen',
        'emailing' => 'E-Mail',
        'caching' => 'Caching',
        'action' => 'Aktion',
        'validation' => 'Validierung',
        'options' => 'Optionen',
        'attributes' => 'HTML Attribute',
    ],
    'sections' => [
        'buttons' => [
            'label' => 'Button Aussehen',
        ],
        'recaptcha' => [
            'label' => 'Google ReCAPTCHA',
        ],
        'ip_restriction' => [
            'label' => 'IP-Beschränkungen',
        ],
        'auto_reply' => [
            'label' => 'Automatische Antworten',
        ],
        'styling' => [
            'label' => 'Formular Aussehen',
            'comment' => 'Alle folgenden Punkte können für jedes Formular und/oder Feld überschrieben werden',
        ],
        'validation' => [
            'label' => 'Validierung Aussehen',
            'comment' => 'Alle folgenden Punkte können für jedes Formular überschrieben werden',
        ],
        'notifications' => [
            'label' => 'Automatische Benachrichtigungen',
        ],
    ],
    'forms' => [
        'field' => [
            'title' => 'Titel',
            'code' => 'Code',
        ],
    ],
    'mail' => [
        'templates' => [
            'autoreply' => 'ABWebDevelopers Forms - Automatische Antwort',
            'notification' => 'ABWebDevelopers Forms - Benachrichtigung',
        ],
    ],
    'voodooForm' => [
        'formCode' => [
            'title' => 'Formular verwenden',
            'description' => 'Definiere das zu verwendende Formular anhand seines Codes',
        ],
        'validation' => [
            'recaptchaFailed' => 'Du musst die reCAPTCHA-Überprüfung abschließen',
            'noData' => 'Keine Daten geliefert',
            'invalidNotificationRecipients' => 'Die Liste der Benachrichtigungsempfänger enthält eine ungültige E-Mail-Adresse',
            'noAutoReplyEmailField' => 'Das Feld für die automatische Antwort per E-Mail konnte nicht ausgewertet werden',
            'noAutoReplyNameField' => 'Das Feld Name der automatischen Antwort konnte nicht ausgewertet werden',
        ],
    ],
    'permissions' => [
        'forms' => 'Formulare verwalten',
        'submissions' => 'Nachrichten verwalten',
    ],
    'controller' => [
        'form' => 'Formular',
        'forms' => 'Formulare',
        'new_form' => 'Neues Formular',
        'edit_form' => 'Formular bearbeiten',
        'field' => 'Feld',
        'options' => [
            'text' => 'Text',
            'email' => 'E-Mail',
            'number' => 'Zahl',
            'date' => 'Datum',
            'textarea' => 'Textfeld',
            'select' => 'Auswahlfeld',
            'checkbox' => 'Checkbox',
            'radio' => 'Radiobox',
            'url' => 'URL',
            'tel' => 'Telefon',
            'file' => 'Datei',
            'image' => 'Bild',
            'password' => 'Passwort',
            'color' => 'Farbe',
            'plaintext' => 'Freitext',
        ],
    ],
    'models' => [
        'all' => [
            'created_at' => 'Angelegt',
            'updated_at' => 'Geändert',
            'sort_order' => [
                'label' => 'Position',
                'up' => 'Auf',
                'down' => 'Ab',
                'successful_up' => 'Feld erfolgreich nach oben verschoben',
                'successful_down' => 'Feld erfolgreich nach unten verschoben',
            ],
            'override' => [
                'label' => 'Systemwert überschreiben',
                'comment' => 'On: Überschreiben | Off: Beibehalten',
            ],
        ],
        'settings' => [
            'enable_caching' => [
                'label' => 'Caching aktivieren',
                'comment' => 'Auswählen, ob das gerenderte Formular zwischengespeichert werden soll oder nicht',
            ],
            'cache_lifetime' => [
                'label' => 'Cache-Lebensdauer',
                'comment' => 'Anzahl der Minuten, die das gerenderte Formular zwischengespeichert werden soll',
            ],
            'form_class' => [
                'label' => 'Formular CSS-Klasse',
                'comment' => 'CSS-Klasse für das Formular. Leer lassen für Defaultwert',
            ],
            'field_class' => [
                'label' => 'Feld CSS-Klasse',
                'comment' => 'CSS-Klasse für das Feld. Leer lassen für Defaultwert',
            ],
            'legend_class' => [
                'label' => 'CSS-Klasse für <legend>. ',
                'comment' => 'CSS-Klasse für die Beschreibung über Checkboxen und Radiobuttons. Leer lassen für Defaultwert',
            ],
            'description_class' => [
                'label' => 'Beschreibung CSS-Klasse',
                'comment' => 'CSS-Klasse für die Beschreibung. Leer lassen für Defaultwert',
            ],
            'group_class' => [
                'label' => 'Gruppe CSS-Klasse',
                'comment' => 'CSS-Klasse für die Gruppe. Leer lassen für Defaultwert',
            ],
            'label_class' => [
                'label' => 'Label CSS-Klasse',
                'comment' => 'CSS Class für das Label. Leer lassen für Defaultwert',
            ],
            'submit_class' => [
                'label' => 'Absende-Button CSS-Klasse',
                'comment' => 'CSS-Klasse der Senden-Schaltfläche. Leer lassen für Defaultwert',
            ],
            'submit_text' => [
                'label' => 'Absende-Button Text',
                'comment' => 'Text, der auf der Schaltfläche "Senden" angezeigt werden soll',
            ],
            'enable_cancel' => [
                'label' => 'Abbrechen aktivieren',
                'comment' => 'Kehrt zum Referer zurück, wenn der Button geklickt wird',
            ],
            'cancel_class' => [
                'label' => 'Abbrechen CSS-Klasse',
                'comment' => 'CSS-Klasse der Abbrechen-Taste (falls aktiviert)',
            ],
            'cancel_text' => [
                'label' => 'Abbrechen Text',
                'comment' => 'Text, der in der Abbrechen-Taste angezeigt werden soll (falls aktiviert)',
            ],
            'saves_data' => [
                'label' => 'Daten speichern?',
                'comment' => 'Wähle aus, ob Übermittlungsdaten in der Datenbank gespeichert werden sollen oder nicht (empfohlen).',
            ],
            'store_ips' => [
                'label' => 'IP-Adressen speichern?',
                'comment' => 'Wähle aus, ob IP-Adressen zusammen mit Übermittlungen gespeichert werden sollen',
            ],
            'enable_recaptcha' => [
                'label' => 'ReCAPTCHA aktivieren',
                'comment' => 'Sollte dieses Formular ein ReCAPTCHA bekommen?',
            ],
            'recaptcha_public_key' => [
                'label' => 'ReCAPTCHA Public Key',
                'comment' => 'Google ReCAPTCHA (öffentlicher) API-Schlüssel',
            ],
            'recaptcha_secret_key' => [
                'label' => 'ReCAPTCHA Secret Key',
                'comment' => 'Google ReCAPTCHA (privater) API Key',
            ],
            'enable_ip_restriction' => [
                'label' => 'Aktiviere die IP-Beschränkung',
                'comment' => 'Aktiviere eine IP-Einschränkung für dieses Formular',
            ],
            'max_requests_per_day' => [
                'label' => 'Maximale Anfragen pro Tag',
                'comment' => 'Maximale Anzahl der täglichen Formulare, die von einer IP gesendet werden können',
            ],
            'throttle_message' => [
                'label' => 'Gedrosselt-Nachricht',
                'comment' => 'Wähle aus, was einem Benutzer angezeigt werden soll, der seine maximale Anzahl der täglichen Formulare überschritten hat',
            ],
            'queue_emails' => [
                'label' => 'E-Mails verzögern?',
                'comment' => 'Wähle aus, ob E-Mails zur Warteschlange hinzugefügt werden sollen oder nicht, anstatt synchron zu senden (empfohlen).',
            ],
            'send_notifications' => [
                'label' => 'Benachrichtigung senden',
                'comment' => 'Entscheide, ob Du für jedes abgesendetes Formular Benachrichtigungen erhalten möchtest.',
            ],
            'notification_template' => [
                'label' => 'Benachrichtigungsvorlage',
                'comment' => 'Benutzerdefinierter E-Mail-Vorlagencode (Einstellungen > E-Mail-Vorlagen)',
            ],
            'notification_recipients' => [
                'label' => 'Benachrichtigungsempfänger',
                'comment' => 'Durch Kommas getrennte E-Mail-Adressen',
            ],
            'auto_reply' => [
                'label' => 'Automatische Antwort?',
                'comment' => 'Sende eine automatische Antwort an den Benutzer, der dieses Formular sendet.',
            ],
            'auto_reply_email_field_id' => [
                'label' => 'E-Mail-Feld für automatische Antwort',
                'comment' => 'Wähle das Feld aus, das als E-Mail-Adresse für die automatische Antwort verwendet werden soll',
            ],
            'auto_reply_name_field_id' => [
                'label' => 'Feld für den Namen der automatischen Antwort',
                'comment' => 'Wähle das Feld aus, das als Name für die automatische Antwort verwendet werden soll',
            ],
            'notif_replyto' => [
                'label' => 'Reply-To Hinzufügen?',
                'comment' => 'Fügt ein Reply-To zu der Benachrichtigungs-E-Mails ein, dass es auf die E-Mail des Benutzers verweist',
            ],
            'notif_replyto_email_field_id' => [
                'label' => 'Benachrichtigung Reply-To E-Mail-Feld',
                'comment' => 'Wähle das Feld aus, das als E-Mail-Adresse für die automatische Antwort verwendet werden soll',
            ],
            'notif_replyto_name_field_id' => [
                'label' => 'Benachrichtigung Reply-To Name-Feld',
                'comment' => 'Wähle das Feld aus, das als Name für die automatische Antwort verwendet werden soll',
            ],
            'auto_reply_template' => [
                'label' => 'Vorlage für automatische Antwort',
                'comment' => 'Benutzerdefinierter E-Mail-Vorlagencode (Einstellungen > E-Mail-Vorlagen)',
            ],
            'field_error_class' => [
                'label' => 'Feld "Fehler" CSS-Klasse',
                'comment' => 'CSS-Klasse, die bei einem fehlerhaften Feld angewendet werden soll',
            ],
            'field_success_class' => [
                'label' => 'Feld "Erfolg" CSS-Klasse',
                'comment' => 'CSS-Klasse zur Anwendung auf ein Erfolgsfeld',
            ],
            'label_error_class' => [
                'label' => 'Label "Fehler" CSS-Klasse',
                'comment' => 'CSS-Klasse, die bei Fehler auf ein Etikett angewendet werden soll',
            ],
            'label_success_class' => [
                'label' => 'Label "Erfolg" CSS-Klasse',
                'comment' => 'CSS-Klasse, um sich bei Erfolg auf ein Label zu bewerben',
            ],
            'form_error_class' => [
                'label' => 'Formular "Fehler" CSS-Klasse',
                'comment' => 'CSS-Klasse, die bei einem Fehler auf ein Formular angewendet werden soll',
            ],
            'form_success_class' => [
                'label' => 'Formular "Erfolg" CSS-Klasse',
                'comment' => 'CSS-Klasse, um sich bei Erfolg auf ein Formular zu bewerben',
            ],
            'on_success' => [
                'label' => 'Aktion für "Erfolgreich gesendet"',
                'comment' => 'Wähle aus, was getan werden soll, wenn das Formular erfolgreich gesendet wurde',
                'options' => [
                    'hide' => 'Formular ausblenden',
                    'clear' => 'Löschen/Zurücksetzen des Formulars',
                    'redirect' => 'Zu einer URL weiterleiten',
                ],
            ],
            'on_success_message' => [
                'label' => 'Nachricht für "Erfolgreich gesendet"',
                'comment' => 'Wähle aus, was als Flash-Nachricht angezeigt werden soll, wenn das Formular erfolgreich gesendet wurde',
                'placeholder' => 'Mitteilung erfolgreich gesendet',
            ],
            'on_success_redirect' => [
                'label' => 'Umleitung für "Erfolgreich gesendet"',
                'comment' => 'Wähle die URL aus, zu der umgeleitet werden soll, wenn das Formular erfolgreich gesendet wurde',
                'placeholder' => '/formular-erfolgreich-uebertragen',
            ],
        ],
        'form' => [
            'title' => [
                'label' => 'Titel',
                'comment' => 'Der Titel des Formulars (Angezeigt in E-Mails, Frontend usw.)',
            ],
            'subtitle' => [
                'label' => 'Untertitel',
                'comment' => 'Der Untertitel des Formulars (Angezeigt in E-Mails, Frontend usw.)',
            ],
            'show_title' => [
                'label' => 'Titel anzeigen',
                'comment' => 'Der Titel wird im Frontend über dem Formular ausgegeben.',
            ],
            'show_subtitle' => [
                'label' => 'Untertitel anzeigen',
                'comment' => 'Der Untertitel wird im Frontend über dem Formular ausgegeben.',
            ],
            'code' => [
                'label' => 'Code',
                'comment' => 'Eindeutiger Formular-Code. Nur a-z, 0-9, Unterstrich. Bindestriche werden nach dem Absenden automatisch durch Unterstriche ersetzt',
            ],
            'description' => [
                'label' => 'Beschreibung',
                'comment' => 'Eine kurze Beschreibung des Formularzwecks',
            ],
        ],
        'field' => [
            'name' => [
                'label' => 'Name',
                'comment' => 'Wird als Bezeichnung für dieses Feld verwendet',
            ],
            'code' => [
                'label' => 'Code',
                'comment' => 'Wird verwendet, um dieses Feld zu identifizieren. Nur a-z, 0-9, Unterstrich. Bindestriche werden nach dem Absenden automatisch durch Unterstriche ersetzt',
            ],
            'type' => [
                'label' => 'Art',
                'comment' => 'Wähle einen Feldtyp',
            ],
            'description' => [
                'label' => 'Beschreibung / Freitext',
                'comment' => 'Optional. Eine Beschreibung dieses Feldes. Wenn "Art" auf "Freitext" eingestellt ist, wird dieser Text ausgegeben. Wenn der Schalter "Beschreibung anzeigen" aktiviert ist, wird dieser Text über Checkboxen und Radiobuttons ohne HTML als <legend> ausgespielt, bei anderen Feldern mit HTML unter dem Formularfeld in einem <aside>',
            ],
            'placeholder' => [
                'label' => 'Platzhalter',
                'comment' => 'Gib hier den Platzhalterattributwert ein. Für ausgewählte Elemente fungiert es als Option.',
            ],
            'default' => [
                'label' => 'Default',
                'comment' => 'Der Standardwert. Verwende den Code für die Auswahl/Radio/Checkbox der Option.',
            ],
            'show_description' => [
                'label' => 'Beschreibung anzeigen',
                'comment' => 'Zeige die Beschreibung im Formular unter der Bezeichnung des Feldes an. Wird ignoriert wenn "Art" auf "Freitext" eingestellt ist.',
            ],
            'required' => [
                'label' => 'Erforderlich',
                'comment' => 'Synonym für das Hinzufügen der "required" Validierungsregel',
            ],
            'multiple' => [
                'label' => 'Mehrfachauswahl',
                'comment' => 'Aktiviert die Mehrfachauswahl in Upload- und Auswahlfeldern',
            ],
            'radio_group' => [
                'label' => 'Gruppenname',
                'comment' => '(Optional) Fasst Radio-Buttons zu einer Gruppe zusammen',
            ],
            'checkbox_group' => [
                'label' => 'Gruppenname',
                'comment' => '(Optional) Fasst Checkboxen zu einer Gruppe zusammen',
            ],
            'validation_rules' => [
                'label' => 'Validierungsregeln',
                'comment' => 'Weitere Informationen findest Du in der Dokumentation: https://wintercms.com/docs/services/validation#available-validation-rules',
            ],
            'validation_message' => [
                'label' => 'Validierungsnachricht',
                'comment' => 'Welche Meldung sollte bei einem Fehler angezeigt werden?',
            ],
            'options' => [
                'label' => 'Optionen',
                'comment' => 'Füge hier Ihre Dropdown-, Radio- oder Checkbox-Optionen hinzu',
                'prompt' => 'Option hinzufügen',
                'fields' => [
                    'option_label' => [
                        'label' => 'Optionen Label',
                        'comment' => 'Wird als Bezeichnung für diese Option verwendet.',
                    ],
                    'option_code' => [
                        'label' => 'Optionen Code',
                        'comment' => 'Wird verwendet, um dieses Feld zu identifizieren. Nur a-z, 0-9, Unterstrich. Bindestriche werden nach dem Absenden automatisch durch Unterstriche ersetzt',
                    ],
                    'is_optgroup' => [
                        'label' => 'Unteroptionen hinzufügen?',
                        'comment' => 'Durch Hinzufügen von Unteroptionen wird diese Option in eine Gruppe von Optionen umgewandelt (e.g. `<optgroup>`)',
                    ],
                    'options' => [
                        'label' => 'Unteroptionen',
                        'comment' => 'Füge dieser Optionsgruppe Unteroptionen hinzu.',
                        'fields' => [
                            'option_label' => [
                                'label' => 'Optionen Label',
                                'comment' => 'Wird als Bezeichnung für diese Option verwendet.',
                            ],
                            'option_code' => [
                                'label' => 'Optionen Code',
                                'comment' => 'Wird verwendet, um dieses Feld zu identifizieren. Nur a-z, 0-9, Unterstrich. Bindestriche werden nach dem Absenden automatisch durch Unterstriche ersetzt',
                            ],
                        ],
                    ],
                ],
            ],
            'attributes' => [
                'label' => 'HTML Attribute',
                'comment' => 'Benutzerdefinierte Attribute für das Feld hinzufügen/überschreiben (input, select, textarea).',
                'prompt' => 'Ein Attribut hinzufügen.',
                'fields' => [
                    'name' => [
                        'label' => 'Attributname',
                        'comment' => 'Der Name des Attributs, e.g. data-id, title, class, etc.',
                    ],
                    'value' => [
                        'label' => 'Attributwert',
                        'comment' => 'Der Wert des Attributs. Leer lassen für boolesche Attribute.',
                    ],
                ],
            ],
            'show_in_email_autoreply' => [
                'label' => 'In automatischen Antwort-Mails anzeigen',
                'comment' => 'Soll der Wert dieses Feldes in den E-Mails mit automatischer Antwort angezeigt werden?',
            ],
            'show_in_email_notification' => [
                'label' => 'In Benachrichtigungs-Mails anzeigen',
                'comment' => 'Sollte der Wert dieses Feldes in Benachrichtigungs-E-Mails angezeigt werden?',
            ],
        ],
    ],
];
