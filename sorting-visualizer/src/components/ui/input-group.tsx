import { forwardRef, ReactElement, ReactNode, Children, cloneElement, ComponentProps } from "react";
import { InputGroup as ChakraInputGroup, InputLeftElement, InputRightElement, Input, Box } from "@chakra-ui/react";

export interface InputGroupProps extends ComponentProps<typeof Box> {
  startElementProps?: ComponentProps<typeof Input>; // FIXED: Use ComponentProps<typeof Input>
  endElementProps?: ComponentProps<typeof Input>;   // FIXED: Use ComponentProps<typeof Input>
  startElement?: ReactNode;
  endElement?: ReactNode;
  children: ReactElement<ComponentProps<typeof Input>>; // FIXED: Use ComponentProps<typeof Input>
  startOffset?: string;
  endOffset?: string;
}

export const InputGroup = forwardRef<HTMLDivElement, InputGroupProps>(
  function InputGroup(props, ref) {
    const {
      startElement,
      startElementProps,
      endElement,
      endElementProps,
      children,
      startOffset = "6px",
      endOffset = "6px",
      ...rest
    } = props;

    const child = Children.only<ReactElement<ComponentProps<typeof Input>>>(children);

    return (
      <ChakraInputGroup ref={ref} {...rest}>
        {startElement && (
          <InputLeftElement pointerEvents="none" {...startElementProps}>
            {startElement}
          </InputLeftElement>
        )}
        {cloneElement(child, {
          ...(startElement && { ps: `calc(var(--input-height) - ${startOffset})` }),
          ...(endElement && { pe: `calc(var(--input-height) - ${endOffset})` }),
          ...children.props,
        })}
        {endElement && (
          <InputRightElement {...endElementProps}>
            {endElement}
          </InputRightElement>
        )}
      </ChakraInputGroup>
    );
  }
);
