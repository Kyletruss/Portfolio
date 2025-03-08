import { Slider as ChakraSlider, HStack } from "@chakra-ui/react";
import * as React from "react";

export interface SliderProps {
  marks?: Array<number | { value: number; label: React.ReactNode }>;
  label?: React.ReactNode;
  showValue?: boolean;
  value?: number | number[]; // Use value for controlled slider state
  defaultValue?: number | number[]; // For uncontrolled state
  onChange?: (value: number | number[]) => void; // To handle value changes
}

export const Slider = React.forwardRef<HTMLDivElement, SliderProps>(function Slider(
  { marks: marksProp, label, showValue, value, defaultValue, onChange, ...rest },
  ref
) {
  const marks = marksProp?.map((mark) => {
    if (typeof mark === "number") return { value: mark, label: undefined };
    return mark;
  });

  const hasMarkLabel = !!marks?.some((mark) => mark.label);

  return (
    <ChakraSlider
      ref={ref}
      value={value}
      defaultValue={defaultValue}
      onChange={onChange}
      {...rest}
    >
      {label && !showValue && <ChakraSlider.Label>{label}</ChakraSlider.Label>}
      {label && showValue && (
        <HStack justify="space-between">
          <ChakraSlider.Label>{label}</ChakraSlider.Label>
          <ChakraSlider.ValueText />
        </HStack>
      )}
      <ChakraSlider.Control data-has-mark-label={hasMarkLabel || undefined}>
        <ChakraSlider.Track>
          <ChakraSlider.Range />
        </ChakraSlider.Track>
        <SliderThumbs value={value} />
        <SliderMarks marks={marks} />
      </ChakraSlider.Control>
    </ChakraSlider>
  );
});

function SliderThumbs(props: { value?: number | number[] }) {
  const { value } = props;
  return (
    <>
      {Array.isArray(value) ? (
        value.map((_, index) => (
          <ChakraSlider.Thumb key={index} index={index}>
            <ChakraSlider.HiddenInput />
          </ChakraSlider.Thumb>
        ))
      ) : (
        <ChakraSlider.Thumb index={0}>
          <ChakraSlider.HiddenInput />
        </ChakraSlider.Thumb>
      )}
    </>
  );
}

interface SliderMarksProps {
  marks?: Array<number | { value: number; label: React.ReactNode }>;
}

const SliderMarks = React.forwardRef<HTMLDivElement, SliderMarksProps>(function SliderMarks(
  { marks },
  ref
) {
  if (!marks?.length) return null;

  return (
    <ChakraSlider.MarkerGroup ref={ref}>
      {marks.map((mark, index) => {
        const value = typeof mark === "number" ? mark : mark.value;
        const label = typeof mark === "number" ? undefined : mark.label;
        return (
          <ChakraSlider.Marker key={index} value={value}>
            <ChakraSlider.MarkerIndicator />
            {label}
          </ChakraSlider.Marker>
        );
      })}
    </ChakraSlider.MarkerGroup>
  );
});
