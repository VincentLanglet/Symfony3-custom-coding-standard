# PSR2 Standard
## From PSR1

- PHP code MUST use the long <?php ?> tags or the short-echo <?= ?> tags;
 it MUST NOT use the other tag variations.

```
<rule ref="Generic.PHP.DisallowShortOpenTag.EchoFound">
    <severity>0</severity>
</rule>
```

- PHP code MUST use only UTF-8 without BOM.

```
<rule ref="Generic.Files.ByteOrderMark"/>
```

- A file SHOULD declare new symbols and cause no other side effects,
 or it SHOULD execute logic with side effects, but SHOULD NOT do both.

```
<rule ref="PSR1.Files.SideEffects"/>
```

- Namespaces and classes MUST follow PSR-0. This means each class is in a file by itself,
 and is in a namespace of at least one level: a top-level vendor name.

```
<rule ref="PSR1.Classes.ClassDeclaration"/>
```

- Class names MUST be declared in StudlyCaps.

```
<rule ref="Squiz.Classes.ValidClassName"/>
```

- Class constants MUST be declared in all upper case with underscore separators.

```
<rule ref="Generic.NamingConventions.UpperCaseConstantName"/>
```

- Method names MUST be declared in camelCase().
```
<rule ref="PSR1.Methods.CamelCapsMethodName"/>
```

## From PSR2

- All PHP files MUST use the Unix LF (linefeed) line ending.

```
<rule ref="Generic.Files.LineEndings">
    <properties>
        <property name="eolChar" value="\n"/>
    </properties>
</rule>
```

- All PHP files MUST end with a single blank line.

```
<rule ref="PSR2.Files.EndFileNewline"/>
```

- The closing ?> tag MUST be omitted from files containing only PHP.

```
<rule ref="PSR2.Files.ClosingTag"/>
```

- There MUST NOT be trailing whitespace at the end of non-blank lines.

```
<rule ref="Squiz.WhiteSpace.SuperfluousWhitespace">
    <properties>
        <property name="ignoreBlankLines" value="true"/>
    </properties>
</rule>
<rule ref="Squiz.WhiteSpace.SuperfluousWhitespace.StartFile">
    <severity>0</severity>
</rule>
<rule ref="Squiz.WhiteSpace.SuperfluousWhitespace.EndFile">
    <severity>0</severity>
</rule>
<rule ref="Squiz.WhiteSpace.SuperfluousWhitespace.EmptyLines">
    <severity>0</severity>
</rule>
```

- There MUST NOT be more than one statement per line.

```
<rule ref="Generic.Formatting.DisallowMultipleStatements"/>
```

- Code MUST use an indent of 4 spaces, and MUST NOT use tabs for indenting.

```
<rule ref="Generic.WhiteSpace.ScopeIndent">
    <properties>
        <property name="ignoreIndentationTokens" type="array" value="T_COMMENT,T_DOC_COMMENT_OPEN_TAG"/>
    </properties>
</rule>
<rule ref="Generic.WhiteSpace.DisallowTabIndent"/>
```

- PHP keywords MUST be in lower case.

```
<rule ref="Generic.PHP.LowerCaseKeyword"/>
```

- The PHP constants true, false, and null MUST be in lower case.

```
<rule ref="Generic.PHP.LowerCaseConstant"/>
```

- When present, there MUST be one blank line after the namespace declaration.

```
<rule ref="PSR2.Namespaces.NamespaceDeclaration"/>
```

- When present, all use declarations MUST go after the namespace declaration.
 There MUST be one use keyword per declaration.
 There MUST be one blank line after the use block.

```
<rule ref="PSR2.Namespaces.UseDeclaration"/>
```

- The extends and implements keywords MUST be declared on the same line as the class name.
 The opening brace for the class go MUST go on its own line;
 the closing brace for the class MUST go on the next line after the body.
 Lists of implements MAY be split across multiple lines, where each subsequent line is indented once.
 When doing so, the first item in the list MUST be on the next line, and there MUST be only one interface per line.

```
<rule ref="PSR2.Classes.ClassDeclaration"/>
```

- Visibility MUST be declared on all properties.
 The var keyword MUST NOT be used to declare a property.
 There MUST NOT be more than one property declared per statement.
 Property names SHOULD NOT be prefixed with a single underscore to indicate protected or private visibility.

```
<rule ref="PSR2.Classes.PropertyDeclaration"/>
```

- Visibility MUST be declared on all methods.

```
<rule ref="Squiz.Scope.MethodScope"/>
<rule ref="Squiz.WhiteSpace.ScopeKeywordSpacing"/>
```

- Method names SHOULD NOT be prefixed with a single underscore to indicate protected or private visibility.

```
<rule ref="PSR2.Methods.MethodDeclaration"/>
```

- Method names MUST NOT be declared with a space after the method name.
 The opening brace MUST go on its own line,
 and the closing brace MUST go on the next line following the body.
 There MUST NOT be a space after the opening parenthesis,
 and there MUST NOT be a space before the closing parenthesis.

```
<rule ref="PSR2.Methods.FunctionClosingBrace"/>
<rule ref="Squiz.Functions.FunctionDeclaration"/>
<rule ref="Squiz.Functions.LowercaseFunctionKeywords"/>
```

- In the argument list, there MUST NOT be a space before each comma,
 and there MUST be one space after each comma.

```
<rule ref="Squiz.Functions.FunctionDeclarationArgumentSpacing">
    <properties>
        <property name="equalsSpacing" value="1"/>
    </properties>
</rule>
<rule ref="Squiz.Functions.FunctionDeclarationArgumentSpacing.SpacingAfterHint">
    <severity>0</severity>
</rule>
```

- Method arguments with default values MUST go at the end of the argument list.

```
<rule ref="PEAR.Functions.ValidDefaultValue"/>
```

- Argument lists MAY be split across multiple lines, where each subsequent line is indented once.
 When doing so, the first item in the list MUST be on the next line, and there MUST be only one argument per line.
 When the argument list is split across multiple lines,
 the closing parenthesis and opening brace MUST be placed together on their own line with one space between them.

```
<rule ref="Squiz.Functions.MultiLineFunctionDeclaration"/>
```

- When present, the abstract and final declarations MUST precede the visibility declaration.
  When present, the static declaration MUST come after the visibility declaration.

```
<rule ref="PSR2.Methods.MethodDeclaration"/>
```

- When making a method or function call, there MUST NOT be a space between the method or function name
 and the opening parenthesis, there MUST NOT be a space after the opening parenthesis,
 and there MUST NOT be a space before the closing parenthesis.
 In the argument list, there MUST NOT be a space before each comma, and there MUST be one space after each comma.
 Argument lists MAY be split across multiple lines, where each subsequent line is indented once.
 When doing so, the first item in the list MUST be on the next line, and there MUST be only one argument per line.

```
<rule ref="Generic.Functions.FunctionCallArgumentSpacing"/>
<rule ref="PSR2.Methods.FunctionCallSignature.SpaceAfterCloseBracket">
    <severity>0</severity>
</rule>
```

- There MUST be one space after the control structure keyword.
 There MUST NOT be a space after the opening parenthesis.
 There MUST NOT be a space before the closing parenthesis.
 There MUST be one space between the closing parenthesis and the opening brace.
 The structure body MUST be indented once.
 The closing brace MUST be on the next line after the body.

```
<rule ref="Squiz.ControlStructures.ControlSignature"/>
<rule ref="Squiz.WhiteSpace.ControlStructureSpacing" />
<rule ref="Squiz.WhiteSpace.ControlStructureSpacing.SpacingAfterOpenBrace">
    <severity>0</severity>
</rule>
<rule ref="Squiz.WhiteSpace.ControlStructureSpacing.SpaceBeforeCloseBrace">
    <severity>0</severity>
</rule>
<rule ref="Squiz.WhiteSpace.ControlStructureSpacing.LineAfterClose">
    <severity>0</severity>
</rule>
<rule ref="Squiz.WhiteSpace.ControlStructureSpacing.NoLineAfterClose">
    <severity>0</severity>
</rule>
<rule ref="Squiz.WhiteSpace.ScopeClosingBrace"/>
<rule ref="Squiz.ControlStructures.ForEachLoopDeclaration"/>
<rule ref="Squiz.ControlStructures.ForLoopDeclaration"/>
<rule ref="Squiz.ControlStructures.LowercaseDeclaration"/>
<rule ref="PSR2.ControlStructures.ControlStructureSpacing"/>
```

- The body of each structure MUST be enclosed by braces.

```
<rule ref="Generic.ControlStructures.InlineControlStructure"/>
```

- The keyword elseif SHOULD be used instead of else if so that all control keywords look like single words.

```
<rule ref="PSR2.ControlStructures/=.ElseIfDeclaration/>
```

- The case statement MUST be indented once from switch,
 and the break keyword (or other terminating keyword) MUST be indented at the same level as the case body.
 There MUST be a comment such as // no break when fall-through is intentional in a non-empty case body.

```
<rule ref="PSR2.ControlStructures.SwitchDeclaration/>
```

- Closures MUST be declared with a space after the function keyword, and a space before and after the use keyword.
 The opening brace MUST go on the same line, and the closing brace MUST go on the next line following the body.
 There MUST NOT be a space after the opening parenthesis of the argument list or variable list,
 and there MUST NOT be a space before the closing parenthesis of the argument list or variable list.
 In the argument list and variable list, there MUST NOT be a space before each comma,
 and there MUST be one space after each comma.
 Closure arguments with default values MUST go at the end of the argument list.
 Argument lists and variable lists MAY be split across multiple lines, where each subsequent line is indented once.
 When doing so, the first item in the list MUST be on the next line,
 and there MUST be only one argument or variable per line.
 When the ending list (whether or arguments or variables) is split across multiple lines,
 the closing parenthesis and opening brace MUST be placed together on their own line with one space between them.

```
<rule ref="Squiz.Functions.MultiLineFunctionDeclaration"/>
```
