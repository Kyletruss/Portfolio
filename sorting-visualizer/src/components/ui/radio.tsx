import { Radio as ChakraRadio, RadioGroup as ChakraRadioGroup } from "@chakra-ui/react";
import * as React from "react";

// Define RadioProps
export interface RadioProps extends React.ComponentProps<typeof ChakraRadio> {
  rootRef?: React.Ref<HTMLDivElement>;
  inputProps?: React.InputHTMLAttributes<HTMLInputElement>;
  children?: React.ReactNode; // Add children prop here
}

export const Radio = React.forwardRef<HTMLInputElement, RadioProps>(function Radio(
  props,
  ref
) {
  const { children, inputProps, rootRef, ...rest } = props;

  return (
    <ChakraRadio ref={rootRef} {...rest}>
      <ChakraRadio.Input ref={ref} {...inputProps} />
      {children && <ChakraRadio.Text>{children}</ChakraRadio.Text>}
    </ChakraRadio>
  );
});

// RadioGroup component directly from Chakra UI
export const RadioGroup = ChakraRadioGroup;
